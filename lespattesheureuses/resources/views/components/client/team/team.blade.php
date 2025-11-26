<section class="flex flex-col justify-center">
    <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium mb-8">{!! __('client/team.team_title') !!}</h2>
    <x-client.global.cards_grid
        number="9"
        image_src="{{asset('assets/images/johndoe.jpg')}}"
        image_alt="{!! __('client/animals.animal_image_alt', ['name' => 'John Doe']) !!}"
        status="{!! __('client/team.volunteer') !!}"
        name="John Doe"
        arg_1="john@doe.com"
        arg_2="0432.54.56.13"
        is-animal="{{false}}"
    />
    <div class="mx-auto mt-8">
        <x-client.global.cta
            route="{{route('client_contact')}}"
            title="{!! __('client/team.join_us_title') !!}">
            {!! __('client/team.join_us') !!}
        </x-client.global.cta>
    </div>

</section>
