@extends('layouts.app')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

@section('content')
	<h1>{{$card->name}}</h1>
	<img src="{{$card->src}}" height="100" width="60">

	<div class="w3-bar w3-black">
		<button class="w3-bar-item w3-button" onclick="openCity('info')">Information</button>
		@auth
			<button class="w3-bar-item w3-button" onclick="openCity('sell')">Sell</button>
		@endauth
	</div>

	<div id="info" class="w3-container city">
		<h2>Printed in: {{$card->expansion}}</h2>
		<h2>Number: {{$card->number}}</h2>
		<h2>Rarity: {{$card->rarity}}</h2>
		<h2>Quantity: {{$card->quantity}}</h2>
		<h2>Price From: {{$card->price_from}}</h2>
	</div>

	@auth
		<div id="sell" class="w3-container city" style="display:none">
			<form action="{{url('api\clist')}}" method="post">
		    	<input type="hidden" name="name" value="{{$card->name}}">
		    	<input type="hidden" name="seller" value="{{Auth::user()->username}}">
		    	<label for="qtty">Quantity</label>
		    	<input type="number" name="quantity" value="1" min="1" id="qtty" required><br>
				<label for="lng">Language</label>
		    	<select id="lng" name="language">
		    		<option value="English">English</option>
		    		<option value="French">French</option>
		    		<option value="German">German</option>
		    		<option value="Spanish">Spanish</option>
		    		<option value="Italian">Italian</option>
		    		<option value="Japanese">Japanese</option>
		    		<option value="Chinese">Chinese</option>
				</select><br>
				<label for="cnd">Condition</label>
				<select id="cnd" name="condition">
					<option value="Mint">Mint</option>
					<option selected value="Near Mint">Near Mint</option>
					<option value="Excellent">Excellent</option>
					<option value="Good">Good</option>
					<option value="Light Played">Light Played</option>
					<option value="Played">Played</option>
					<option value="Poor">Poors</option>
				</select><br>
				<label for="comment">Comments</label>
				<input type="text" id="comment" name="comment"><br>
				<input type="checkbox" id="cbx_fullart" name="fullArt" value="1">
				<label for="cbx_fullart">FullArt?</label><br>	
				<input type="checkbox" id="cbx_foil" name="foil" value="1">
				<label for="cbx_foil">Foil?</label><br>
				<input type="checkbox" id="cbx_signed" name="signed" value="1">
				<label for="cbx_signed">Signed?</label><br>
				<input type="checkbox" id="cbx_uber" name="uber" value="1">
				<label for="cbx_uber">Uber?</label><br>
				<input type="checkbox" id="cbx_playset" name="playset" value="1">
				<label for="cbx_playset">Playset?</label><br>
				<label for="price">Price</label>
				<input type="number" id="price" name="price" min="0.02" step="0.01" required><br>
		        {{--{{csrf_field()}}--}}
		        <input type="submit" name="submit">
		    </form>
		</div>
	@endauth

	@if (count($clist) >= 1)
		<table>
			<th>Seller</th>
			<th>Product Information</th>
			<th>Offer</th>
			@foreach ($clist as $item)
				@auth
					@if ($item->seller == Auth::user()->username)
						<tr>
							<td>TEST{{$item->seller}}</td>
							<td>{{$item->condition}} - {{$item->language}} - {{$item->fullart}} - {{$item->foil}} - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
							<td>{{$item->price}} - {{$item->quantity}} <!-- EDIT --></td>
						</tr>
					@else
						<tr>
							<td>{{$item->seller}}</td>
							<td>{{$item->condition}} - {{$item->language}} - {{$item->fullart}} - {{$item->foil}} - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
							<td>{{$item->price}} - {{$item->quantity}}</td>
						</tr>
					@endif
				@endauth
				@guest
					<tr>
						<td>{{$item->seller}}</td>
						<td>{{$item->condition}} - {{$item->language}} - {{$item->fullart}} - {{$item->foil}} - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
						<td>{{$item->price}} - {{$item->quantity}}</td>
					</tr>
				@endguest
	    	@endforeach
	    </table>
	@endif

	<script>
		function openCity(cityName) {
			var i;
			var x = document.getElementsByClassName("city");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";  
			}
			document.getElementById(cityName).style.display = "block";  
		}
	</script>

@stop