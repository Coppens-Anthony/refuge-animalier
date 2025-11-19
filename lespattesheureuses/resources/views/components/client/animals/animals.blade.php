<section class="flex flex-col gap-8">
    <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{!! __('client/animals.animals_title') !!}</h2>
    <x-client.global.filters_bar.filters/>
    <x-client.global.cards_grid
        number="14"
        image_src="{{asset('assets/images/max.jpg')}}"
        image_alt="{!! __('client/animals.animal_image_alt', ['name' => 'Max']) !!}"
        status="Adoptable"
        name="Max"
        arg_1="3 ans"
        arg_2="Berger allemand"
    />
</section>
