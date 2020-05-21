@extends('layouts.app')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

@section('content')
	<h1>{{$card->name}}</h1>
	<img src="{{$card->src}}" height="100" width="60">

	<div class="w3-bar w3-black">
		<button class="w3-bar-item w3-button" onclick="openTab('info')">Information</button>
		@auth
			<button class="w3-bar-item w3-button" onclick="openTab('sell')">Sell</button>
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
			<form action="{{url('api/clist')}}" method="post">
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
				<tr>
					@auth
						@if ($item->seller == Auth::user()->username)
							<td>{{$item->seller}}</td>
							<td>{{$item->condition}} - {{$item->language}} - {{$item->fullart}} - {{$item->foil}} - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
							<td>
								{{$item->price}} - {{$item->quantity}} - <button onclick="showEdit({{$item->id}})">EDIT</button><button><a href="{{url('delete/'.$item->id)}}">DELETE</a></button>
								<div style="display:none;" id="{{'editDiv'.$item->id}}">
									<form action="{{url('api/clist/'.$item->id)}}" method="post">
      									{{ method_field('PUT') }}
								    	<input type="hidden" name="name" value="{{$card->name}}">
								    	<input type="hidden" name="seller" value="{{Auth::user()->username}}">
								    	<label for="{{'qtty'.$item->id}}">Quantity</label>
								    	<input type="number" name="quantity" value="1" min="1" id="{{'qtty'.$item->id}}" required><br>
										<label for="{{'lng'.$item->id}}">Language</label>
								    	<select id="{{'lng'.$item->id}}" name="language">
								    		<option value="English">English</option>
								    		<option value="French">French</option>
								    		<option value="German">German</option>
								    		<option value="Spanish">Spanish</option>
								    		<option value="Italian">Italian</option>
								    		<option value="Japanese">Japanese</option>
								    		<option value="Chinese">Chinese</option>
										</select><br>
										<label for="{{'cnd'.$item->id}}">Condition</label>
										<select id="{{'cnd'.$item->id}}" name="condition">
											<option value="Mint">Mint</option>
											<option selected value="Near Mint">Near Mint</option>
											<option value="Excellent">Excellent</option>
											<option value="Good">Good</option>
											<option value="Light Played">Light Played</option>
											<option value="Played">Played</option>
											<option value="Poor">Poors</option>
										</select><br>
										<label for="{{'comment'.$item->id}}">Comments</label>
										<input type="text" id="{{'comment'.$item->id}}" name="comment"><br>
										<input type="checkbox" id="{{'cbx_fullart'.$item->id}}" name="fullArt" value="1">
										<label for="{{'cbx_fullart'.$item->id}}">FullArt?</label><br>	
										<input type="checkbox" id="{{'cbx_foil'.$item->id}}" name="foil" value="1">
										<label for="{{'cbx_foil'.$item->id}}">Foil?</label><br>
										<input type="checkbox" id="{{'cbx_signed'.$item->id}}" name="signed" value="1">
										<label for="{{'cbx_signed'.$item->id}}">Signed?</label><br>
										<input type="checkbox" id="{{'cbx_uber'.$item->id}}" name="uber" value="1">
										<label for="{{'cbx_uber'.$item->id}}">Uber?</label><br>
										<input type="checkbox" id="{{'cbx_playset'.$item->id}}" name="playset" value="1">
										<label for="{{'cbx_playset'.$item->id}}">Playset?</label><br>
										<label for="{{'price'.$item->id}}">Price</label>
										<input type="number" id="{{'price'.$item->id}}" name="price" min="0.02" step="0.01" required><br>
								        {{--{{csrf_field()}}--}}
								        <input type="submit" name="submit">
								    </form>
								</div>
							</td>
						@endif
					@endauth
				</tr>
	    	@endforeach
			@foreach ($clist as $item)
				<tr>
					@auth
						@if ($item->seller != Auth::user()->username)
							<td>{{$item->seller}}</td>
							<td>{{$item->condition}} - {{$item->language}} - {{$item->fullart}} - {{$item->foil}} - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
							<td>{{$item->price}} - {{$item->quantity}}</td>
						@endif
					@endauth
					@guest
						<td>{{$item->seller}}</td>
						<td>{{$item->condition}} - {{$item->language}} - {{$item->fullart}} - {{$item->foil}} - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
						<td>{{$item->price}} - {{$item->quantity}}</td>
					@endguest
				</tr>
	    	@endforeach
	    </table>
	@endif

	<script>
		function showEdit($id) {
			if (document.getElementById("editDiv"+$id).style.display == "block") {
				document.getElementById("editDiv"+$id).style.display = "none";
			} else {
				document.getElementById("editDiv"+$id).style.display = "block";
			}
		}

		function openTab(tab) {
			var i;
			var x = document.getElementsByClassName("city");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";  
			}
			document.getElementById(tab).style.display = "block";  
		}
	</script>
@stop