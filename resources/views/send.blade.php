@extends('layouts.app')

@section('content')

    <h1>Create Card</h1>

    <form action="{{url('test')}}" method="post">

        <input type="text" name="id" placeholder="Enter id">
        {{--{{csrf_field()}}--}}
        <input type="submit" name="submit">

    </form>

@stop
