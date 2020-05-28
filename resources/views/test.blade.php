@foreach($card as $item)
    {{ $item }}
@endforeach
<br><br>
@foreach($card_list as $item)
    {{ $item->id }}
    {{ $item->name }}
    {{ $item->quantity }}
    {{ $item->price }}

    <br>
@endforeach