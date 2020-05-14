@extends('layouts.app')

@section('content')

    <h1>Create Card</h1>

    <form action="{{url('api\cards')}}" method="post">

        <input type="text" name="name" placeholder="Enter title">
        <input type="text" name="expansion" placeholder="Enter expansion">
        <input type="text" name="number" placeholder="Enter number">
        <input type="text" name="rarity" placeholder="Enter rarity">
        <input type="text" name="game" placeholder="Enter game">
        <input type="text" name="src" placeholder="Enter src">
        {{--{{csrf_field()}}--}}
        <input type="submit" name="submit">

    </form>

@stop