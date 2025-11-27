<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <aside class="bg-primary w-1/7 fixed top-0 left-0 h-full shadow-2xl">
        <div class="relative w-fit mb-8 mt-4 mx-auto">
            <a href="{{route('dashboard')}}" class="absolute top-0 left-0 h-full w-full" title="{!! __('admin/dashboard.to_dashboard') !!}"></a>
            <x-client.global.logo/>
        </div>
        <nav class="w-fit ml-4">
            <h2></h2>
            <ul class="flex flex-col gap-6">
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
                    route="index.requests"
                    title="{!! __('admin/nav.to_requests') !!}"
                    image="folder"
                    image_alt="{!! __('admin/nav.request_icon') !!}"
                    text="{!! __('admin/nav.requests') !!}"
                />
                <livewire:admin.global.item_nav
                    route="index.validations"
                    title="{!! __('admin/nav.to_validations') !!}"
                    image="clock"
                    image_alt="{!! __('admin/nav.clock_icon') !!}"
                    text="{!! __('admin/nav.validations') !!}"
                />
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
            </ul>
        </nav>
    </aside>
</div>
