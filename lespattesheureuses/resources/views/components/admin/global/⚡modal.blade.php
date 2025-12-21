<?php

use Livewire\Component;

new class extends Component {
    public string $modalName = 'open';
};
?>

<div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="{{$modalName}}" @keydown.escape.window="{{$modalName}} = false"></div>
<div x-show="{{$modalName}}" wire:ignore.self @click.outside="{{$modalName}} = false"
     @keydown.escape.window="{{$modalName}} = false"
     class="p-6 fixed w-[50vw] z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
    <div class="absolute z-60 cursor-pointer top-2 right-2" @click="{{$modalName}} = false">
        <svg viewBox="0 0 24 24" fill="black" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path d="M16 8L8 16M8.00001 8L16 16" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round"></path>
            </g>
        </svg>
    </div>
    {{$slot}}
</div>
