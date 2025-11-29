<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="col-span-3 border-1 border-primary px-4 rounded-2xl">
    <section class="mt-4">
        <h3>{!! __('admin/dashboard.stats') !!}</h3>
        <div class="flex justify-between items-center mt-4">
            <p>< Octobre 2025 ></p>
            <img src="{{asset('assets/icons/download.svg')}}" alt="{!! __('admin/dashboard.download_icon') !!}">
        </div>
    </section>
</div>
