@extends('layouts.app')



@section('content')

    <h1>Create Card</h1>

    <form action="{{url('api/cards/store')}}" method="post">

        <input type="text" name="name" placeholder="Enter title"> <!-- this name=title comes from create_posts_table -->
        <input type="text" name="expansion" placeholder="Enter expansion"> <!-- this name=title comes from create_posts_table -->
        <input type="text" name="number" placeholder="Enter number"> <!-- this name=title comes from create_posts_table -->
        <input type="text" name="rarity" placeholder="Enter rarity"> <!-- this name=title comes from create_posts_table -->
        <input type="text" name="game" placeholder="Enter game"> <!-- this name=title comes from create_posts_table -->
        <input type="text" name="src" placeholder="Enter src"> <!-- this name=title comes from create_posts_table -->
        {{--{{csrf_field()}}--}}
        <input type="submit" name="submit">

    </form>

@stop
