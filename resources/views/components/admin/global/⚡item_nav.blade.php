<?php

use Livewire\Component;

new class extends Component {

    public string $route;
    public string $title;
    public string $image;
    public string $image_alt;
    public string $text;
    public bool $isDangerous = false;
};
?>

<div>
    <li>
        <div class="relative w-fit flex gap-2 items-center">
            <a wire:navigate="{{route($route)}}" href="{{route($route)}}" title="{{$title}}" class="absolute top-0 left-0 h-full w-full"></a>
            <img src="{{asset('assets/icons/' . $image . '.svg')}}" alt="{{$image_alt}}" class="relative z-10 pointer-events-none">
            <p class="relative z-10 pointer-events-none {{$isDangerous ? 'text-red-400' : ''}}">{{$text}}</p>
            @if(request()->routeIs($route))
                <img src="{{asset('assets/icons/arrow.svg')}}" alt="{!! __('admin/nav.arrow_icon') !!}" class="relative z-10 pointer-events-none">
            @endif
        </div>
    </li>
</div>
