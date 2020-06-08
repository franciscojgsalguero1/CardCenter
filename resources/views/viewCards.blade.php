@extends('layouts.app')

@section('title', "Cardcenter - Card List")
@section('content')
<div class="flex-container">
    <div>
        @if (count($data) >= 1)

            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <th>Name</th>
                    <th>Expansion</th>
                    <th>Number</th>
                    <th>Rarity</th>
                    <th>Quantity</th>
                    <th>Price From</th>
                    <th>Game</th>
                </tr>

                @foreach ($data as $item)
                    <tr>
                        <td><a href="{{url('view/'.$item->id)}}">{{$item->name}}</a></td>
                        <td>{{$item->expansion}}</td>
                        <td>{{$item->number}}</td>
                        <td>{{$item->rarity}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price_from}}</td>
                        <td>{{$item->game}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</div>
@stop
