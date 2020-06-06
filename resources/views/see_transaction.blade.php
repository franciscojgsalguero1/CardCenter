@extends('layouts.app')

@section('content')

<div class="flex-container">
	<table id="info-card">
		<th>Card Name</th>
		<th>Seller</th>
		<th>Product Information</th>
		<th>Offer</th>
		<th>Cancel</th>

	</table>
</div>
{{$purchases}}
{{$sales}}
@stop