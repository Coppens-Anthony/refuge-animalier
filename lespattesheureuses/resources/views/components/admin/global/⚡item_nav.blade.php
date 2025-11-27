<?php

use Livewire\Component;

new class extends Component {

    public string $route;
    public string $title;
    public string $image;
    public string $image_alt;
    public string $text;
};
?>

<div>
    <li>
        <div class="relative w-fit flex gap-2">
            <a href="{{route($route)}}" title="{{$title}}" class="absolute top-0 left-0 h-full w-full"></a>
            <img src="{{asset('assets/icons/' . $image . '.svg')}}" alt="{{$image_alt}}">
            <p>{{$text}}</p>
            @if(request()->routeIs($route))
                <img src="{{asset('assets/icons/arrow.svg')}}" alt="{!! __('admin/nav.arrow_icon') !!}">
            @endif
        </div>
    </li>
</div>
