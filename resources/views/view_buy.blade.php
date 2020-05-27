
@extends('layouts.app')
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
th{
    background-color: #012169;
    color: white;
}
h2, h1, label{
    text-align: center;
    color: black;
}
</style>
@section('content')

<div class="flex-container">
    <div>
    @if (count($data) >= 1)
        <table class='table table-hover table-responsive table-bordered'>
            <tr>    
                <th>Article</th>
                <th>Seller</th>
                <th>Price unit</th>
                <th>Quantity</th>
                <th>Total price</th>
                <th>Date of pai</th>
                <th>Confirm</th>
            </tr>

            @foreach ($data as $item)
                @if($item->confirm ==0 )
                    <tr>                   
                        <td>{{$item->card_name}}
                	   <td>{{$item->seller}}</td>
                	   <td>{{$item->price_unit}}</td>
                	   <td>{{$item->quantity}}</td>
                        <td>{{$item->price_unit*$item->quantity}}
                	   <td>{{$item->date_paid}}</td>
                       <td><button><a href="{{url('api/transactions/updateConfirm/'.$item->id)}}">Confim</a></button>
                    </tr>
                @endif
            @endforeach
        </table>
    @endif
</div>
</div>
@stop