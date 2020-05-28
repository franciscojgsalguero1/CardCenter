@extends('layouts.app')
@section('content')

	<h1>Resumen:</h1>
	<span>Seller: {{$card["seller"]}}</span>
	<span>Quantity: {{$card["t_quantity"]}}</span>
	<span>Price: {{$card["t_price"]}}</span>

	<table>
	<th>Qtty</th>
	<th>Name</th>
	<th>Information</th>
	<th>Price</th>
		
			@foreach($card_list as $item)
			<tr>
				<td>{{$item->quantity}}x</td>
				<td>{{$item->name}}</td>
				<td>stuff</td>
			    <td>{{$item->price}}</td>
		    </tr>
			@endforeach
		
	</table>
@stop