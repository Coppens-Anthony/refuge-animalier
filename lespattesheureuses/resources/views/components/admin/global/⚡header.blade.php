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
            <a href="{{route('show.members', $this->authUser->id)}}" title="{!! __('admin/nav.to_profile') !!}"
               class="absolute top-0 left-0 h-full w-full"></a>
            <p class="leading-tight">{{$this->authUser->firstname . ' ' . $this->authUser->lastname}}</p>
            @if($this->authUser->avatar)
                <img src="{{ asset('avatars/originals/'.$this->authUser->avatar) }}"
                     srcset="
                            {{asset('avatars/variants/300x300/'.$this->authUser->avatar)}} 300w,
                            {{asset('avatars/variants/600x600/'.$this->authUser->avatar)}} 600w,
                            {{asset('avatars/variants/900x900/'.$this->authUser->avatar)}} 900w,
                            {{asset('avatars/variants/1200x1200/'.$this->authUser->avatar)}} 1200w"
                     sizes="(max-width: 768px) 100vw, 50vw"
                     alt="{!! __('client/animals.animal_image_alt', ['name' => $this->authUser->firstname . ' ' . $this->authUser->lastname]) !!}"
                     class="rounded-full object-cover w-12 h-12 border-2 border-primary">
            @else
                Avatar
            @endif
        </div>
    </header>
</div>
