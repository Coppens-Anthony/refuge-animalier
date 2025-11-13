<section>
    <h2 class="sr-only">{!! __('client/home.stats_title') !!}</h2>
    <ul class="flex flex-col lg:flex-row justify-between">
        <li>
            <x-client.home.stat
                title="{!! __('global.collected_animals') !!}"
                number="42"
                image_src="{{ asset('assets/icons/home.svg') }}"
                image_alt="{!! __('global.home_icon') !!}"
            />
        </li>
        <li class="flex justify-center">
            <x-client.home.stat
                title="{!! __('global.adoptions') !!}"
                number="24"
                image_src="{{ asset('assets/icons/heart.svg') }}"
                image_alt="{!! __('global.heart_icon') !!}"
            />
        </li>
        <li class="flex justify-end">
            <x-client.home.stat
                title="{!! __('global.animals_searching_family') !!}"
                number="18"
                image_src="{{ asset('assets/icons/paws.svg') }}"
                image_alt="{!! __('global.paws_icon') !!}"
            />
        </li>
    </ul>
</section>
