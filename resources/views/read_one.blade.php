@extends('layouts.app')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

@section('content')

<h1>{{$card->name}} </h1>

<div class="w3-bar w3-white" id="tabs">
	<button class="w3-bar-item w3-button" onclick="openTab(event, 'info')">Information <i class="fas fa-info-circle"></i></button>
	@auth
		<button class="w3-bar-item w3-button" onclick="openTab(event, 'sell')">
			Sell <i class="fas fa-shopping-cart"></i>
		</button>
	@endauth
</div>

<div class="flex-container">
	<div>
		<img src="{{$card->src}}" height="200" width="160">
	</div>
	<div id="info" class="tabcontent">
		<table id="info-card">
			<tr>
				<td>Printed in:</td>
				<td>{{$card->expansion}}</td>
			</tr>
			<tr>
				<td>Number:</td>
				<td>{{$card->number}}</td>
			</tr>
			<tr>
				<td>Quantity:</td>
				<td>{{$card->quantity}}</td>
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
	@auth
		<div class="flex-container">
			<div id="sell" class="w3-container tabcontent" style="display:none">
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
					<label for="cbx_fullart">FullArt?</label>
					<input type="checkbox" id="cbx_foil" name="foil" value="1">
					<label for="cbx_foil">Foil?</label><br>
					<input type="checkbox" id="cbx_signed" name="signed" value="1">
					<label for="cbx_signed">Signed?</label>
					<input type="checkbox" id="cbx_uber" name="uber" value="1">
					<label for="cbx_uber">Uber?</label>
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
</div>
	<div class="flex-container">
		<div>
			@if (count($clist) >= 1)
				<table class='table table-hover table-responsive table-bordered'>
					<th>Seller</th>
					<th>Product Information</th>
					<th>Offer</th>
					@foreach ($clist as $item)
						@switch($item->language)
							@case("English")
								@php ($flag = "https://www.countryflags.io/gb/flat/64.png")
								@break
							@case("German")
								@php ($flag = "https://www.countryflags.io/de/flat/64.png")
								@break
							@case("French")
								@php ($flag = "https://www.countryflags.io/fr/flat/64.png")
								@break
							@case("Spanish")
								@php ($flag = "https://www.countryflags.io/es/flat/64.png")
								@break
							@case("Italian")
								@php ($flag = "https://www.countryflags.io/it/flat/64.png")
								@break
							@case("Japanese")
								@php ($flag = "https://www.countryflags.io/jp/flat/64.png")
								@break
							@case("Chinese")
								@php ($flag = "https://www.countryflags.io/cn/flat/64.png")
								@break
						@endswitch
						<tr>
							@auth
								@if ($item->seller == Auth::user()->username)
									<td>{{$item->seller}}</td>
									<td>
										<span>{{$item->condition}}</span>
										<img class="flag" src="{{$flag}}">
										@if ($item->fullart == 1)
											<i class="fab fa-foursquare" data-toggle="tooltip" data-placement="bottom" title="Full art"></i>
										@endif
										@if ($item->foil == 1)
											<i class="fas fa-star" data-toggle="tooltip" data-placement="bottom" title="Foil"></i>
										@endif
										@if ($item->signed == 1)
											<i class="fas fa-signature" data-toggle="tooltip" data-placement="bottom" title="Signed"></i>
										@endif
										@if ($item->uber == 1)
											<i class="far fa-gem" data-toggle="tooltip" data-placement="bottom" title="Uber"></i>
										@endif
										@if ($item->playset == 1)
											<i class="fas fa-dice-four" data-toggle="tooltip" data-placement="bottom" title="Play set"></i>
										@endif
										<span>{{$item->comment}}</span>
									</td>
									<td>
										<span>{{$item->price}}€</span>
										<span>{{$item->quantity}}</span>
										<button class="btn" onclick="showEdit({{$item->id}})">
											<i class="fas fa-edit"></i>
										</button>
										<button class="btn">
											<a href="{{url('delete/'.$item->id)}}"><i class="fas fa-trash-alt"></i></a>
										</button>
										<div style="display:none;" id="{{'editDiv'.$item->id}}">
											<form action="{{url('api/clist/'.$item->id)}}" method="post">
												{{ method_field('PUT') }}
												<input type="hidden" name="name" value="{{$card->name}}">
												<input type="hidden" name="seller" value="{{Auth::user()->username}}">
												<label for="{{'qtty'.$item->id}}">Quantity</label>
												<input type="number" name="quantity" value="{{$item->quantity}}" min="1" id="{{'qtty'.$item->id}}" required><br>
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
												<input type="text" id="{{'comment'.$item->id}}" value="{{$item->comment}}" name="comment"><br>
												<input type="checkbox" id="{{'cbx_fullart'.$item->id}}"  name="fullArt" value="1" 
												@if ($item->fullart == 1) checked @endif>
												<label for="{{'cbx_fullart'.$item->id}}">FullArt?</label><br>	
												<input type="checkbox" id="{{'cbx_foil'.$item->id}}" name="foil" value="1"
												@if ($item->foil == 1) checked @endif>
												<label for="{{'cbx_foil'.$item->id}}">Foil?</label><br>
												<input type="checkbox" id="{{'cbx_signed'.$item->id}}" name="signed" value="1"
												@if ($item->signed == 1) checked @endif>
												<label for="{{'cbx_signed'.$item->id}}">Signed?</label><br>
												<input type="checkbox" id="{{'cbx_uber'.$item->id}}" name="uber" value="1"
												@if ($item->uber == 1) checked @endif>
												<label for="{{'cbx_uber'.$item->id}}">Uber?</label><br>
												<input type="checkbox" id="{{'cbx_playset'.$item->id}}" name="playset" value="1"
												@if ($item->playset == 1) checked @endif>
												<label for="{{'cbx_playset'.$item->id}}">Playset?</label><br>
												<label for="{{'price'.$item->id}}">Price</label>
												<input type="number" id="{{'price'.$item->id}}" name="price" value="{{$item->price}}" min="0.02" step="0.01" required><br>
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
						@switch($item->language)
							@case("English")
								@php ($flag = "https://www.countryflags.io/gb/flat/64.png")
								@break
							@case("German")
								@php ($flag = "https://www.countryflags.io/de/flat/64.png")
								@break
							@case("French")
								@php ($flag = "https://www.countryflags.io/fr/flat/64.png")
								@break
							@case("Spanish")
								@php ($flag = "https://www.countryflags.io/es/flat/64.png")
								@break
							@case("Italian")
								@php ($flag = "https://www.countryflags.io/it/flat/64.png")
								@break
							@case("Japanese")
								@php ($flag = "https://www.countryflags.io/jp/flat/64.png")
								@break
							@case("Chinese")
								@php ($flag = "https://www.countryflags.io/cn/flat/64.png")
								@break
						@endswitch
						<tr>
							@auth
								@if ($item->seller != Auth::user()->username)
									<td>{{$item->seller}}</td>
									<td>
										<span>{{$item->condition}}</span>
										<img class="flag" src="{{$flag}}">
										@if ($item->fullart == 1)
											<i class="fab fa-foursquare" data-toggle="tooltip" data-placement="bottom" title="Full art"></i>
										@endif
										@if ($item->foil == 1)
											<i class="fas fa-star" data-toggle="tooltip" data-placement="bottom" title="Foil"></i>
										@endif
										@if ($item->signed == 1)
											<i class="fas fa-signature" data-toggle="tooltip" data-placement="bottom" title="Signed"></i>
										@endif
										@if ($item->uber == 1)
											<i class="far fa-gem" data-toggle="tooltip" data-placement="bottom" title="Uber"></i>
										@endif
										@if ($item->playset == 1)
											<i class="fas fa-dice-four" data-toggle="tooltip" data-placement="bottom" title="Play set"></i>
										@endif
										<span>{{$item->comment}}</span>
									</td>
									<td>
										<span>{{$item->price}}€</span>
										<span>{{$item->quantity}}</span>
										<button class="btn" onclick="showBuy({{$item->id}})">
											<i class="fas fa-cart-plus"></i>
										</button>
										<form action="{{url('api/transactions')}}" method="post" style="display:none;" id="{{'buy'.$item->id}}">
											<input type="hidden" value="{{$item->name}}" name="card_name">
											<input type="hidden" value="{{$item->id}}" name="card_seller_id">
											<input type="hidden" value="{{$item->seller}}" name="seller">
											<input type="hidden" value="{{Auth::user()->username}}" name="buyer">
											<select name="t_quantity" >
												@for ($i = 1; $i <= $item->quantity; $i++)
													<option value="{{$i}}">{{$i}}</option>
												@endfor	
											</select>
											<input type="hidden" value="{{$item->price}}" name="price_unit">
											{{--{{csrf_field()}}--}}
											<input type="submit" name="submit">
										</form>
									</td>
								@endif
							@endauth
							@guest
								<td>{{$item->seller}}</td>
								<td>
									<span>{{$item->condition}}</span>
									<img class="flag" src="{{$flag}}"> 
									@if ($item->fullart == 1)
										<i class="fab fa-foursquare" data-toggle="tooltip" data-placement="bottom" title="Full art"></i>
									@endif
									@if ($item->foil == 1)
										<i class="fas fa-star" data-toggle="tooltip" data-placement="bottom" title="Foil"></i>
									@endif
									@if ($item->signed == 1)
										<i class="fas fa-signature" data-toggle="tooltip" data-placement="bottom" title="Signed"></i>
									@endif
									@if ($item->uber == 1)
										<i class="far fa-gem" data-toggle="tooltip" data-placement="bottom" title="Uber"></i>
									@endif
									@if ($item->playset == 1)
										<i class="fas fa-dice-four" data-toggle="tooltip" data-placement="bottom" title="Play"></i>
									@endif
									<span>{{$item->comment}}</span>
								</td>
								<td>
									<span>{{$item->price}}€</span>
									<span>{{$item->quantity}}</span>
									<button class="btn" onclick="showBuy({{$item->id}})">
										<i class="fas fa-cart-plus"></i>
									</button>
								</td>
							@endguest
						</tr>
					@endforeach
				</table>
			@endif
		</div>
	</div>
</div>

<script>
	function showEdit(id) {
		if (document.getElementById("editDiv"+id).style.display == "block") {
			document.getElementById("editDiv"+id).style.display = "none";
		} else {
			document.getElementById("editDiv"+id).style.display = "block";
		}
	}

	function openTab(evt, tab) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(tab).style.display = "block";
		evt.currentTarget.className += " active";
	}

	function showBuy(id) {
		if (document.getElementById("buy"+id).style.display == "block") {
			document.getElementById("buy"+id).style.display = "none";
		} else {
			document.getElementById("buy"+id).style.display = "block";
		}
	}
</script>
@stop