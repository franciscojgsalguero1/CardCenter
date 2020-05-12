@extends('layouts.app')

@section('content')
    @if (count($data) >= 1)
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Expansion</th>
                <th>Rarity</th>
                <th>Game</th>
                <th>Src</th>
                <th>button</th>
            </tr>

            @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->expansion}}-{{$item->number}}</td>
                    <td>{{$item->rarity}}</td>
                    <td>{{$item->game}}</td>
                    <td><img src='{{$item->src}}' height=200 width=160></td>
                    <td><a href="{{url('test/'.$item->id)}}">here</a><td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection

@stop
