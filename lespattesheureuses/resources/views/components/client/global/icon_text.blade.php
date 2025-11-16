@props(['image_src', 'image_alt'])

<img src="{{$image_src}}" alt="{{$image_alt}}">
<p>{{$slot}}</p>
