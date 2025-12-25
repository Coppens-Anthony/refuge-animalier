<?php

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Computed;

new class extends Component {

    #[Computed]
    public function authUser()
    {
        return auth()->user();
    }
};
?>

<div>
    <aside class="hidden lg:block bg-primary shadow-2xl fixed top-0 left-0 h-full z-40 w-48">
        <h2 class="sr-only">Menu</h2>

        <div class="relative w-fit mb-8 pt-4 mx-auto px-4">
            <a href="{{route('dashboard')}}"
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
            </ul>
        </nav>
    </aside>
</div>
