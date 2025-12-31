<?php

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Computed;

new class extends Component {
    public bool $isOpen = false;

    public function toggleMenu()
    {
        $this->isOpen = !$this->isOpen;
    }

    #[Computed]
    public function authUser()
    {
        return auth()->user();
    }
};
?>

<div>
    <button
        wire:click="toggleMenu"
        class="lg:hidden fixed top-5 right-4 z-30 p-2 bg-primary rounded-lg cursor-pointer"
        aria-label="Toggle menu">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            @if($isOpen)
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            @else
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            @endif
        </svg>
    </button>

    @if($isOpen)
        <div
            wire:click="toggleMenu"
            class="lg:hidden fixed inset-0 bg-black/75 z-30">
        </div>
    @endif

    <aside
        class="fixed top-0 h-full z-40 bg-primary shadow-2xl transition-transform duration-300 ease-in-out lg:left-0 lg:translate-x-0 lg:w-48 right-0 w-72 {{ $isOpen ? 'translate-x-0' : 'translate-x-full' }}">
        <h2 class="sr-only">Menu</h2>

        <div class="relative w-fit mb-8 pt-4 mx-auto px-4">
            <a wire:navigate="{{route('dashboard')}}" href="{{route('dashboard')}}"
               class="absolute top-0 left-0 h-full w-full"
               title="{!! __('admin/dashboard.to_dashboard') !!}">
            </a>
            <x-client.global.logo/>
        </div>

        <nav class="px-4">
            <h3 class="sr-only">{{__('global.navigation')}}</h3>
            <ul class="flex flex-col gap-4">
                <livewire:admin.global.item_nav
                    route="dashboard"
                    title="{!! __('admin/nav.to_dashboard') !!}"
                    image="dashboard"
                    image_alt="{!! __('admin/nav.dashboard_icon') !!}"
                    text="{!! __('admin/nav.dashboard') !!}"
                />
                <livewire:admin.global.item_nav
                    route="index.animals"
                    title="{!! __('admin/nav.to_animals') !!}"
                    image="admin_paw"
                    image_alt="{!! __('admin/nav.animals_icon') !!}"
                    text="{!! __('admin/nav.animals') !!}"
                />
                <livewire:admin.global.item_nav
                    route="index.adoptions"
                    title="{!! __('admin/nav.to_requests') !!}"
                    image="folder"
                    image_alt="{!! __('admin/nav.request_icon') !!}"
                    text="{!! __('admin/nav.adoptions') !!}"
                />
                @can('view-any', User::class)
                    <livewire:admin.global.item_nav
                        route="index.validations"
                        title="{!! __('admin/nav.to_validations') !!}"
                        image="clock"
                        image_alt="{!! __('admin/nav.clock_icon') !!}"
                        text="{!! __('admin/nav.validations') !!}"
                    />
                @endcan
                <livewire:admin.global.item_nav
                    route="index.messages"
                    title="{!! __('admin/nav.to_messages') !!}"
                    image="messages"
                    image_alt="{!! __('admin/nav.message_icon') !!}"
                    text="{!! __('admin/nav.messages') !!}"
                />
                <livewire:admin.global.item_nav
                    route="index.members"
                    title="{!! __('admin/nav.to_members') !!}"
                    image="members"
                    image_alt="{!! __('admin/nav.member_icon') !!}"
                    text="{!! __('admin/nav.members') !!}"
                />
                @can('view-any', User::class)
                    <livewire:admin.global.item_nav
                        route="index.database"
                        title="{!! __('admin/nav.to_db') !!}"
                        image="db"
                        image_alt="{!! __('admin/nav.db_icon') !!}"
                        text="{!! __('admin/nav.db') !!}"
                    />
                @endcan
                <li class="lg:hidden mt-8 pt-6 border-t border-black">
                    <a href="{{route('show.members', $this->authUser->id)}}"
                       wire:navigate="{{route('show.members', $this->authUser->id)}}"
                       title="{!! __('admin/nav.to_profile') !!}"
                       class="flex items-center gap-3 p-3 rounded-xl bg-black/5 hover:bg-black/10 transition-colors">
                        @if($this->authUser->avatar)
                            <img src="{{ asset('avatars/originals/'.$this->authUser->avatar) }}"
                                 srcset="
                                 {{asset('avatars/variants/300x300/'.$this->authUser->avatar)}} 300w,
                                 {{asset('avatars/variants/600x600/'.$this->authUser->avatar)}} 600w"
                                 sizes="48px"
                                 alt="{!! __('client/animals.animal_image_alt', ['name' => $this->authUser->firstname . ' ' . $this->authUser->lastname]) !!}"
                                 class="rounded-full object-cover w-12 h-12 border-2 border-black/20">
                        @else
                            <div class="w-12 h-12 rounded-full bg-black/10 flex items-center justify-center text-black text-sm font-medium">
                                {{substr($this->authUser->firstname, 0, 1)}}{{substr($this->authUser->lastname, 0, 1)}}
                            </div>
                        @endif
                        <div class="flex-1">
                            <p class="text-black font-medium">
                                {{$this->authUser->firstname . ' ' . $this->authUser->lastname}}
                            </p>
                            <p class="text-black/50 text-sm">Voir mon profil</p>
                        </div>
                        <svg class="w-5 h-5 text-black/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </li>
                <li class="mt-8">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            title="{!! __('admin/nav.to_logout') !!}"
                            class="cursor-pointer transition-all text-red-500 flex gap-2 items-center">
                            <img src="{{asset('assets/icons/logout.svg')}}" alt="{!! __('admin/nav.logout_icon') !!}">
                            {!! __('admin/nav.logout') !!}
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>
</div>
