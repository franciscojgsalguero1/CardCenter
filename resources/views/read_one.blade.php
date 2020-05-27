@extends('layouts.app')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.flex-container {
  display: flex;
  align-items: stretch;
  margin-left: 20%;
}
.flex-container > div {
  background-color: ;
  color: white;
  text-align: center;
}
#info{
	margin-left: 10%;
}
#tabs{
	margin-left: 20%;
	margin-right: 80%;
	color: white;
}
th{
    background-color: #012169;
    color: white;
}
h2, h1, label{
	text-align: center;
	color: black;
}
#info-card{
	font-size: 28px;
}
.tooltiptext {
  visibility: hidden;
  display: none;
  }
#cosa:hover .tooltiptext {
	z-index: 1;
  visibility: visible;
  display: block;
  opacity: 1;
}
#flags{
	width: 25px;
	height: 25px;
}
</style>
@section('content')

<h1>{{$card->name}} </h1>
	<div class="w3-bar w3-white" id="tabs">
		<button class="w3-bar-item w3-button" onclick="openTab('info')">Information <i class="fas fa-info-circle"></i></button>
		@auth
			<button class="w3-bar-item w3-button" onclick="openTab('sell')">Sell <i class="fas fa-shopping-cart"></i></button>
		@endauth
	</div>

	<div class="flex-container">
		
	<div>
		<img src="{{$card->src}}" height="200" width="160">
	</div>

	<div id="info">
		<table id="info-card">
			<tr>
				<td> Printed in:</td>
				<td> {{$card->expansion}}</td>
			</tr>
			<tr>
				<td> Number:</td>
				<td> {{$card->number}}</td>
			</tr>
			<tr>
				<td>Quantity:</td>
				<td>{{$card->quantity}}<td>
			</tr>
			<tr>
				<td>Raraity:</td>
				<td>{{$card->rarity}}</td>
			</tr>
			<tr>
				<td>Price from:</td>
				<td>{{$card->price_from}}</td>
			</tr>
	</table>
	</div>
</div>
	@auth
	<div class="flex-container">
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
	</div>
	@endauth
	<br>
	<div class="flex-container">
		<div>
	@if (count($clist) >= 1)
		<table class='table table-hover table-responsive table-bordered'>
			<th>Seller</th>
			<th>Product Information</th>
			<th>Offer</th>
			@foreach ($clist as $item)
				@if($item->language == "English")
					@php
						$salida = "https://www.countryflags.io/gb/flat/64.png";
					@endphp
				@elseif($item->language == "German")
					@php
						$salida = "https://www.countryflags.io/be/flat/64.png";
					@endphp

				@elseif($item->language == "French")
					@php
						$salida = "https://www.countryflags.io/fr/flat/64.png";
					@endphp
				@elseif($item->language == "Spanish")
					@php
						$salida = "https://www.countryflags.io/es/flat/64.png";
					@endphp
				@elseif($item->language == "Itailan")
					@php
						$salida = "https://www.countryflags.io/it/flat/64.png";
					@endphp
				@elseif($item->language == "Japanese")
					@php
						$salida = "https://www.countryflags.io/jp/flat/64.png";
					@endphp
				@else
					@php
						$salida = "https://www.countryflags.io/cn/flat/64.png";
					@endphp
				@endif			
				<tr>
					@auth
						@if ($item->seller == Auth::user()->username)
							<td>{{$item->seller}}</td>
							<td>{{$item->condition}} - <img id="flags"  src="{{$salida}}"> - {{$item->fullart}} - @if ($item->foil != 0)<i class="fas fa-star" id="cosa"><span class="tooltiptext">foil</span></i>@else &nbsp @endif - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
							<td>
								{{$item->price}}€ - {{$item->quantity}} - <button class="btn" onclick="showEdit({{$item->id}})"><i class="fas fa-edit"> </i></button><button class="btn"><a href="{{url('delete/'.$item->id)}}"><i class="fas fa-trash-alt"></i></a></button><button class="btn" onclick="showBuy({{$item->id}})"><i class="fas fa-cart-plus"></i></button>
									<form action="{{url('api/transactions')}}" method="post" style="display:none;" id="{{'buy'.$item->id}}">
										<input type="hidden" value="{{$item->seller}}" name="seller">
										<input type="hidden" value="{{auth::user()->username}}" name="buyer">
										<input type="hidden" value="{{$card->name}}" name="card_name">
										<select name="quantity" >
										@for($i = 0; $i <= $item->quantity; $i++)
											<option value="{{$i}}">{{$i}}</option>
										@endfor	
										</select>
										@php
											$tracking = rand(1,1000);
										@endphp
										<input type="hidden" value="{{$item->price}}" name="price_unit">
										<input type="hidden" value="send" name="status">
										<input type="hidden" value="1" name="certified">
										<input type="hidden" value="{{$tracking}}" name="tracking_code">
										<input type="hidden" value="{{ date('Y-m-d H:i:s') }}" name="date_paid">
										{{--{{csrf_field()}}--}}
										<input type="submit" name="submit">
									</form>
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
							<td>{{$item->condition}} - <img id="flags"  src="{{$salida}}"> - {{$item->fullart}} - @if ($item->foil != 0)<i class="fas fa-star" id="cosa"><span class="tooltiptext">foil</span></i>@else &nbsp @endif - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
							<td>{{$item->price}}€ - {{$item->quantity}}</td>
						@endif
					@endauth
					@guest
						<td>{{$item->seller}}</td>
						<td>{{$item->condition}} - <img id="flags" src="{{$salida}}">  {{$item->fullart}} - @if ($item->foil != 0)<i class="fas fa-star" id="cosa"><span class="tooltiptext">foil</span></i>@else &nbsp @endif - {{$item->signed}} - {{$item->uber}} - {{$item->playset}} - {{$item->comment}}</td>
						<td>{{$item->price}}€ - {{$item->quantity}}</td>
					@endguest
				</tr>
				@if ($item->foil != 0)<i class="fas fa-star"></i>@endif
				
	    		
	    	@endforeach
	    </table>	    
	@endif
</div>
</div>
<i class="ae flag"></i>
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

		function showBuy($id) {
			if (document.getElementById("buy"+$id).style.display == "block") {
				document.getElementById("buy"+$id).style.display = "none";
			} else {
				document.getElementById("buy"+$id).style.display = "block";
			}
		}


	</script>
@stop