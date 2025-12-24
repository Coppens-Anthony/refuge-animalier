@props(['animals', 'adoptions', 'animalsAdoptable'])

<section>
    <h2 class="sr-only">{!! __('client/home.stats_title') !!}</h2>
    <ul class="flex flex-col gap-10 md:flex-row lg:justify-between">
        <li class="flex justify-center">
            <x-client.home.stat
                title="{!! __('global.collected_animals') !!}"
                :number="$animals->count()"
                image_src="{{ asset('assets/icons/home.svg') }}"
                image_alt="{!! __('global.home_icon') !!}"
            />
        </li>
        <li class="flex justify-center">
            <x-client.home.stat
                title="{!! __('global.adoptions') !!}"
                :number="$adoptions->count()"
                image_src="{{ asset('assets/icons/heart.svg') }}"
                image_alt="{!! __('global.heart_icon') !!}"
            />
        </li>
        <li class="flex justify-center">
            <x-client.home.stat
                title="{!! __('global.animals_searching_family') !!}"
                :number="$animalsAdoptable->count()"
                image_src="{{ asset('assets/icons/paws.svg') }}"
                image_alt="{!! __('global.paws_icon') !!}"
            />
        </li>
    </ul>
</section>
