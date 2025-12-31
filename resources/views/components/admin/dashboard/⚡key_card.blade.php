<?php

use Livewire\Component;

new class extends Component {
    public string $title;
    public string $number;
    public string $route;
    public string $link_title;
    public string $image;
    public string $image_alt;
};
?>

<div class="bg-primary rounded-xl border-primary border-4 hover:bg-white hover:border-primary duration-300 hover:duration-300 w-full">
    <li class="relative">
        <a href="{{route($route)}}" wire:navigate="{{route($route)}}" title="{{$link_title}}" class="absolute top-0 left-0 w-full h-full"></a>
        <article class="flex items-center gap-2 py-4 w-fit mx-auto">
            <img src="{{asset('assets/icons/' . $image . '.svg')}}" alt="{{$image_alt}}" class="w-10 h-10 md:w-auto md:h-auto">
            <div>
                <p class="text-3xl/6">{{$number}}</p>
                <h4>{{$title}}</h4>
            </div>
        </article>
    </li>
</div>
