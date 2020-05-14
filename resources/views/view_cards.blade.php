@extends('layouts.app')

@section('content')
    @if (count($data) >= 1)
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <th>Name</th>
                <th>Expansion</th>
                <th>Rarity</th>
                <th>Game</th>
                <th>Src</th>
            </tr>

            @foreach ($data as $item)
                <tr>
                    <td><a href="{{url('test/'.$item->id)}}">{{$item->name}}</a></td>
                    <td>{{$item->expansion}}-{{$item->number}}</td>
                    <td>{{$item->rarity}}</td>
                    <td>{{$item->game}}</td>
                    <td><img src='{{$item->src}}' height=200 width=160></td>
                </tr>
            @endforeach
        </table>
    @endif

@stop
