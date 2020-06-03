@extends('layouts.app', ['game' => $id ?? '' ?? ''])

@section('content')
<div id="demo" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>

    @switch ($id ?? '')
        @case ("Force of Will")
            @php
                $src1 = "https://d12h0em1d7ppg.cloudfront.net/content/banner/249c0c96-8089-4af4-a3f2-d01f71db5d5f.jpg";
                $src2 = "https://www.fowsystem.com/fr/Images/rhl9BAg/bRaTBj6jxtpZhg==/files/TCGFACTORY%20Y%20FOW%20INTERIOR.jpg";
                $src3 = "https://cdn.shopify.com/s/files/1/2375/2517/products/prewviewa_1024x1024.jpg?v=1521443530";
            @endphp
            @break
        @case ("Magic The Gathering")
            @php
                $src1 = "https://i.ytimg.com/vi/dghBjvR6oic/maxresdefault.jpg";
                $src2 = "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSs-uPHdnyCq5_UQPRGxVwu4CbyIAC_J1tXr6tG44ESBLtNQM5Y&usqp=CAU";
                $src3 = "https://mtgproshop.com/wp-content/uploads/2018/08/Poster-set.jpg";
            @endphp
            @break
        @case ("Pokémon")
            @php
                $src1 = "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTaNVpJoCQzWF5rO_CxmMstKQgLudTCT_uJSdakRap8WuMU1urQ&usqp=CAU";
                $src2 = "https://www.gtsdistribution.com/images/POKEMON_L.JPG";
                $src3 = "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRQbZisv90YtzZP5hOZr0fMinDK1S6biQBbWLuoXCTjqWDdIqmY&usqp=CAU";
            @endphp
            @break
        @case ("Yu-Gi-Oh")
            @php
                $src1 = "https://as.com/meristation/imagenes/2019/09/19/header_image/531856241568917546.jpg";
                $src2 = "https://static.fandomspot.com/images/08/1817/00-featured-best-yugioh-games-ever-seto-and-yami.jpg";
                $src3 = "https://as.com/meristation/imagenes/2019/05/06/noticias/1557134804_813638_1557134858_noticia_normal.jpg";
            @endphp
            @break
        @default
            @php
                $src1 = "https://d12h0em1d7ppg.cloudfront.net/content/banner/249c0c96-8089-4af4-a3f2-d01f71db5d5f.jpg";
                $src2 = "https://www.fowsystem.com/fr/Images/rhl9BAg/bRaTBj6jxtpZhg==/files/TCGFACTORY%20Y%20FOW%20INTERIOR.jpg";
                $src3 = "https://cdn.shopify.com/s/files/1/2375/2517/products/prewviewa_1024x1024.jpg?v=1521443530";
            @endphp
    @endswitch
    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{$src1}}" alt="Image 1" width="100%" height="300">
        </div>
        <div class="carousel-item">
            <img src="{{$src2}}" alt="Image 2" width="100%" height="300">
        </div>
        <div class="carousel-item">
            <img src="{{$src3}}" alt="Image 3" width="100%" height="300">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
<div class="flex-container-main" style="margin:0">
    <div>
        <h1 class="titulos">Last Add</h1>
    </div>
    <div>
        <h1 class="titulos">Best Price</h1>
    </div>
</div>
<div class="flex-container-main">
    <div class="flex-container-main">
        @php ($i=0)
        @foreach ($first_cards as $item)
            @if($i<3)
                <div>
                    <a href="{{url('view/'.$item->id)}}" ><img src="{{$item->src}}" class="img-main"></a>
                    <br>
                    <b data-toggle="tooltip" data-placement="top" title="{{$item->name}}">{{$item->name}}</b>
                    <br>
                    <b class="titels">{{$item->expansion}}-{{$item->number}} ({{$item->rarity}})</b>
                    @php($i++)
                </div>
            @endif
        @endforeach
    </div>
    <div class="flex-container-main">
        @php($j=0)
        @foreach ($cardlist as $item)
        @if($j<3)
        <div>
            @foreach($all_cards as $img)
            @if($item->name == $img->name)
            <a href="{{url('view/'.$img->id)}}"><img src="{{$img->src}}" class="img-main"></a>
            @endif
            @endforeach
            @php($j++)
            <br>
            <div class="nombre">
                <b>{{$item->name}}</b>
            </div>
            <b>{{$item->price}}€ / unit</b>
            @endif
        </div>
        @endforeach
    </div>
</div>
<div class="flex-container-main" style="margin-top:0">
    <div>
        <table>
            @php ($i=0)
            @foreach($first_cards as $item)
            @php($i++)
            @if($i>3)
            <tr>
                <td>{{$i}}</td>
                <td><a href="{{url('view/'.$item->id)}}" ><i class="fas fa-images"></i></a></td>
                <td>{{$item->name}}</td>
                <td>{{$item->expansion}}-{{$item->number}} ({{$item->rarity}})</td>
            </tr>
            @endif
            @endforeach
        </table>
    </div >
    <div>
        <table>
            @php ($j=0)

            @foreach($cardlist as $item)
            <tr>
                @php($j++)
                @if($j>3)
                <td>{{$j}}</td>
                @foreach($all_cards as $img)
                @if($item->name == $img->name)
                <td>
                    <a href="{{url('view/'.$img->id)}}"><i class="fas fa-images" ></i></a>
                </td>
                @endif
                @endforeach     
                <td>{{$item->name}}</td>
                <td>{{$item->price}}€ / unit</td>
            </tr>
            @endif
            @endforeach
        </table>
    </div>
</div>
@stop