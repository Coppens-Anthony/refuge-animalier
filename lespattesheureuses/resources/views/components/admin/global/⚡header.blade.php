<?php

use Livewire\Component;

new class extends Component
{
    public string $title;
};
?>

<div class="h-fit w-full">
    <header class="flex justify-between items-center">
        <h2>{{$title}}</h2>
        <div class="flex items-center gap-2 relative">
            <a href="" title="" class="absolute top-0 left-0 h-full w-full"></a>
            <p>John Doe</p>
            <img src="{{asset('assets/images/johndoe.jpg')}}" alt="" class="rounded-full object-cover w-12 h-12 border-2 border-primary">
        </div>
    </header>
</div>
