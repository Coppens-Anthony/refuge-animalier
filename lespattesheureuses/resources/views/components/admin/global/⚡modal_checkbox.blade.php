<?php

use Livewire\Attributes\Modelable;
use Livewire\Component;

new class extends Component {
    public array $options = [];

    #[Modelable]
    public array $selected = [];
    public string $fieldName = '';
};
?>

<div class="relative">
    <div x-data="{ open: false }" class="flex flex-col gap-2">
        <p class="font-semibold">{{$slot}} <span class="text-secondary">*</span></p>
        <button
            type="button"
            @click="open = !open"
            class="rounded-xl border-primary border-3 p-2 cursor-pointer w-full flex justify-between items-center">
            <span>
                @if(empty($selected))
                    @if(empty($options))
                        {{__('global.select_first_specie')}}
                    @else
                        {{__('global.to_select')}}
                    @endif
                @else
                    @foreach($options as $option)
                        @if(in_array($option['value'], $selected))
                            {{ $option['trad'] }},
                        @endif
                    @endforeach
                @endif
            </span>
            <svg
                class="w-3 h-3"
                fill="none"
                stroke="black"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div
            x-show="open"
            @click.outside="open = false"
            @keydown.escape.window="open = false"
            class="absolute top-18 z-10 mt-1 w-full bg-white border border-primary rounded-lg shadow-lg max-h-60 overflow-y-auto">
            @foreach($options as $option)
                <div class="flex gap-2 p-2 hover:bg-gray-200">
                    <input
                        type="checkbox"
                        wire:model.live="selected"
                        name="{{$fieldName . '_' . $option['value']}}"
                        value="{{$option['value']}}"
                        id="{{$fieldName . '_' . $option['value']}}"
                        class="rounded border-primary">
                    <label for="{{$fieldName . '_' . $option['value']}}" class="cursor-pointer flex-1">
                        {{$option['trad']}}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
