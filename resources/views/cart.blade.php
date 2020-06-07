@extends('layouts.app')

@section('title', "Cardcenter - Cart")
@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="flex-container-cart">
	<table id="info-card">
		<th>Card Name</th>
		<th>Seller</th>
		<th>Information</th>
		<th>Offer</th>
		<th>Cancel</th>
		@php ($total_compra=0)
		@php ($cantidad_total=0)
		@foreach($transactions as $card)
			@switch($card->language)
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

			@switch($card->condition)
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
			@php($total_compra += $card->t_quantity * $card->price_unit)
			@php($cantidad_total += $card->t_quantity)
			<tr>
				<td class="centertable"><a href="{{url('view/'.$card->card_id)}}">{{$card->card_name}}</a></td>
				<td class="centertable">{{$card->seller}}</td>
				<td class="centertable">
					<span><i title="{{$card->condition}}" class="{{$condition}}"></i></span>
					<img title="{{$card->language}}" class="flag" src="{{$flag}}">
				</td>
				<td class="centertable">
					<span>{{$card->price_unit}}€</span>
					<select id="card_counter">
						@for ($i=1; $i <= $card->t_quantity; $i++)
							@if($i==$card->t_quantity)
								<option selected id="{{$i}}" value="{{$i}}">{{$i}}</option>
							@else
								<option id="{{$i}}" value="{{$i}}">{{$i}}</option>
							@endif
						@endfor
					</select>
				</td>
				<td class="centertable">
					<button class="btn">
						<a id="button_delete" href="{{url('transaction_delete/'.$card->id.'/'.$card->t_quantity)}}">
							<i class="fas fa-trash-alt"></i>
						</a>
					</button>
				</td>
			</tr>
		@endforeach
	</table>
</div>
<div class="text-center" id="buy">
	<h2>total {{$total_compra}}€ </h2>
	<h2>total cartas {{$cantidad_total}}</h2>
	<button class="btn"><a href="{{url('/confirm/button_buy_all/'.Auth::user()->username)}}">BUY ALL</a></button>
</div>
@stop