<?php

use Livewire\Component;

new class extends Component
{
    public string $modalName = 'open';
};
?>

<div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="{{$modalName}}"></div>
<div x-show="{{$modalName}}" @click.outside="{{$modalName}} = false" @keydown.escape.window="{{$modalName}} = false" class="p-6 fixed w-[50vw] z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
    {{$slot}}
</div>
