@props(['title'])

<x-client.global.layout>
    <x-client.global.basic_section
        title="{!! __('client/home.intro_title') !!}"
        desc="{!! __('client/home.intro_desc') !!}"
        links="{{true}}"
        image_src="{{ asset('assets/images/home_intro.png') }}"
        image_alt="{!! __('client/home.intro_image_alt') !!}"
    />
    <div class="flex flex-col gap-16">
        <x-client.home.stats_section/>
        <x-client.home.animals/>
        <section class="flex flex-col items-center md:flex-row gap-8 md:gap-15 lg:gap-30 mb-16 lg:mb-32">
            <div class="flex flex-col gap-2 md:w-2/3 lg:w-1/2">
                <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{!! __('client/home.contact_title') !!}</h2>
                <p>{!! __('client/home.contact_desc') !!}</p>
                <div class="mt-6 flex gap-8 justify-center md:justify-start">
                    <x-client.global.button route="{{route('client_contact')}}"
                                            title="{!! __('client/header.to_contact') !!}">{!! __('client/home.contact_button') !!}</x-client.global.button>
                </div>
            </div>
            <div class="md:w-1/2 relative">
                <img src="{{asset('assets/images/home_contact.jpg')}}" alt="{!! __('client/home.contact_image_alt') !!}"
                     class="w-full h-full rounded-4xl">
            </div>
        </section>
    </div>
</x-client.global.layout>
