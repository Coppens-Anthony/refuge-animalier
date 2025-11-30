<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <section class="flex gap-30 items-center">
        <div class="flex flex-col gap-8 w-1/2">
            <div class="flex gap-4 items-center">
                <h3 class="text-2xl">John Doe</h3>
                <x-client.global.status
                    isInCard="{{false}}"
                >
                    {!! __('admin/global.volunteer') !!}
                </x-client.global.status>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/email.svg')}}" alt="{!! __('global.email_icon') !!}">
                    <a href="mailto:lespattesheureuse@gmail.com" {!! __('global.email_title') !!} class="link">lespattesheureuse@gmail.com</a>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/telephone.svg')}}" alt="{!! __('global.telephone_icon') !!}">
                    <a href="tel:0123.45.67.89" {!! __('global.telephone_title') !!} class="link">0123.45.67.89</a>
                </div>
            </div>
        </div>
        <div class="w-1/2">
            <img src="{{asset('assets/images/johndoe.jpg')}}" alt="" class="rounded-4xl object-cover">
        </div>
    </section>
</div>
