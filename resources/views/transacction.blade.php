@extends('layouts.app')

@section('content')
<div class="flex-container">
	<table id="info-card">
		<th> seller</th>
		<th> quantity</th>
		<th> price for unit</th>
		<th> Price total </th>
		<th></th>
		<th></th>
		@php ($total_compra=0)
		@php ($cantidad_total=0)
	@foreach($transacction as $operation)
		@php($total_compra += $operation->t_quantity*$operation->price_unit)
		@php($cantidad_total += $operation->t_quantity)
		<tr>
			<td>{{$operation->seller}}</td>
			<td>{{$operation->t_quantity}}</td>
			<td>{{$operation->price_unit}}</td>	
			<td>{{$operation->t_quantity * $operation->price_unit}} €</td>
			<td>
			
				<button class="btn"><a href="{{url('transaction_add/'.$operation->id .'/'.$operation->t_quantity .'/' .$operation->card_seller_id)}}">dadasdadsda</a></button>
			<td>
				<button class="btn"><a href="{{url('transaction_delete/'.$operation->id)}}"><i class="fas fa-trash-alt"></i></a></button>
			</td>
		</tr>
	@endforeach
	</table>
total {{$total_compra}}€
<br>
total cartas {{$cantidad_total}}
</div>
@stop