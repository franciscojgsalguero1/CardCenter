@extends('layouts.app')

@section('title', "Cardcenter - Sales")
@section('content')
<h2>Sales</h2>
<div class="col text-center">
	<button><h2><a href="{{route('sales')}}" >Sales</a></h2></button> - <button><h2><a href="{{route('purchases')}}">Purchases</a></h2></button>
</div>
<br>
<div class="flex-container">
	<div>
		<table id="info-card">
			<th>Card Name</th>
			<th>Buyer</th>
			<th>Information</th>
			<th>Price</th>
			<th>Quantity</th>
			@foreach($sales as $sale)
				@switch($sale->language)
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

				@switch($sale->condition)
					@case("Near Mint")
						@php ($condition = "fas fa-laugh-beam text-success")
						@break
					@case("Excellent")
						@php ($condition = "fas fa-smile-beam text-success")
						@break
					@case("Good")
						@php ($condition = "fas fa-smile-beam text-dark")
						@break
					@case("Poor")
						@php ($condition = "fas fa-sad-cry text-danger")
						@break
				@endswitch
				<tr>
					<td class="centertable"><a href="{{url('view/'.$sale->card_id)}}">{{$sale->card_name}}</a></td>
					<td class="centertable">{{$sale->buyer}}</td>
					<td class="centertable">
						<span><i title="{{$sale->condition}}" class="{{$condition}}"></i></span>
						<img title="{{$sale->language}}" class="flag" src="{{$flag}}">
					</td>
					<td class="centertable">{{$sale->price_unit}}€</td>
					<td class="centertable">{{$sale->t_quantity}}</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
@stop