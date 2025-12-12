<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="open"></div>
<div x-show="open" @click.outside="open = false" @keydown.escape.window="open = false" class="p-6 fixed w-[50vw] z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
    {{$slot}}
</div>
