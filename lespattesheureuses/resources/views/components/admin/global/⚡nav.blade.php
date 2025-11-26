<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <aside class="bg-primary w-1/7 fixed top-0 left-0 h-full">
        <div class="relative w-fit mb-8 mt-4">
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
                    text="Animaux"
                />

            </ul>
        </nav>
    </aside>
</div>
