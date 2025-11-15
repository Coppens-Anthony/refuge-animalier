<section class="relative">
    <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium mb-8">{!! __('client/home.animals_title') !!}</h2>
    <x-client.global.cards_grid
        number="3"
    />
    <div class="absolute top-[50%] right-[-2rem] w-[120%] -z-20
    sx:w-[115%]
    md:top-[15%]
    lg:right-[-4rem]">
        <img src="{{asset('assets/icons/organic_2.svg')}}" alt="{!! __('global.organic_1_alt') !!}" class="w-full h-full">
    </div>
    <div class="w-fit mx-auto">
        <x-client.global.button route="{{route('client_animals')}}" title="{!! __('client/home.to_animals') !!}">{!! __('client/home.all_animals') !!}</x-client.global.button>
    </div>
</section>
