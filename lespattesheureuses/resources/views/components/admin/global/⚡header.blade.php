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
        <div class="flex items-center gap-2 relative">
            <a href="{{route('show.members', $this->authUser->id)}}" title="{!! __('admin/nav.to_profile') !!}"
               class="absolute top-0 left-0 h-full w-full"></a>
            <p class="leading-tight">John Doe</p>
            <img src="{{asset('assets/images/johndoe.jpg')}}" alt=""
                 class="rounded-full object-cover w-12 h-12 border-2 border-primary">
        </div>
    </header>
</div>
