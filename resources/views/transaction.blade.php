@extends('layouts.app')

@section('content')
<div class="flex-container">
	<table id="info-card">
		<th>Card Name</th>
		<th>Seller</th>
		<th>Product Information</th>
		<th>Offer</th>
		<th>Cancel</th>
		@php ($total_compra=0)
		@php ($cantidad_total=0)
		@foreach($transaction as $card)
			@php($total_compra += $card->t_quantity * $card->price_unit)
			@php($cantidad_total += $card->t_quantity)
			<tr>
				<td>{{$card->card_name}}</td>
				<td>{{$card->seller}}</td>
				<td>
					<span>{{$card->condition}}</span>
					<span>{{$card->language}}</span>
				</td>
				<td>
					<span>{{$card->price_unit}}</span>
					<span>{{$card->t_quantity}}</span>
				</td>
				<td>
					<button class="btn"><a href="{{url('transaction_delete/'.$card->id)}}"><i class="fas fa-trash-alt"></i></a></button>
				</td>
			</tr>
		@endforeach
	</table>
	<span>total {{$total_compra}}€ </span>
	<br>
	<span>total cartas {{$cantidad_total}}</span>
</div>
<button class="btn"><a href="{{url('/confirm/button_buy_all/'.Auth::user()->username)}}">BUY ALL</a></button>
@stop