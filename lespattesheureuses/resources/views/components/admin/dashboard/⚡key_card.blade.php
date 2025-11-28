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

<div class="w-1/5 bg-primary rounded-xl border-primary border-4 hover:bg-white hover:border-primary">
    <li class="relative">
        <a href="{{route($route)}}" title="{{$link_title}}" class="absolute top-0 left-0 w-full h-full"></a>
        <article class="flex items-center gap-2 py-4 w-fit mx-auto">
            <img src="{{asset('assets/icons/' . $image . '.svg')}}" alt="{{$image_alt}}">
            <div>
                <p class="text-3xl/6">{{$number}}</p>
                <h3>{{$title}}</h3>
            </div>
        </article>
    </li>
</div>
