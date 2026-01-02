<?php

use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $title;

    #[Computed]
    public function authUser()
    {
        return auth()->user();
    }
};
?>

<div class="h-fit w-full mb-8">
    <header class="flex justify-between items-center">
        <h2 class="text-2xl">{{$title}}</h2>
        <div class="hidden lg:flex lg:items-center lg:gap-2 lg:relative">
            <a wire:navigate="{{route('show.members', $this->authUser->id)}}" href="{{route('show.members', $this->authUser->id)}}" title="{!! __('admin/nav.to_profile') !!}"
               class="absolute top-0 left-0 h-full w-full"></a>
            <p class="leading-tight">{{$this->authUser->firstname . ' ' . $this->authUser->lastname}}</p>
            @if(str_starts_with($this->authUser->avatar, 'public/assets/images/'))
                <img src="{{asset(str_replace('public/assets/', 'assets/', $this->authUser->avatar))}}"
                     alt="{!! __('client/animals.animal_image_alt', ['name' => $this->authUser->firstname . ' ' . $this->authUser->lastname]) !!}"
                     class="avatar">
            @else
                <img src="{{ Storage::url('avatars/originals/'.$this->authUser->avatar) }}"
                     srcset="
                {{Storage::url('avatars/variants/300x300/'.$this->authUser->avatar)}} 300w,
                {{Storage::url('avatars/variants/600x600/'.$this->authUser->avatar)}} 600w,
                {{Storage::url('avatars/variants/900x900/'.$this->authUser->avatar)}} 900w"
                     sizes="(max-width: 768px) 48px, 48px"
                     alt="{!! __('global.pp_icon') !!}"
                     class="avatar">
            @endif
        </div>
    </header>
</div>
