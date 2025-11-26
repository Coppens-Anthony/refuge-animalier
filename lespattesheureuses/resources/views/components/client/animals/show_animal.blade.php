@php
    $args = [
        '3 ans',
        'Berger allemand',
        'Mâle',
        'Pelage feu',
        'Pas de vaccin'
    ];
@endphp

<section class="mb-32">
    <div class="flex flex-col md:flex-row md:gap-30 md:items-center mb-8">
        <div class="flex flex-col gap-8 md:w-1/2">
            <div class="flex items-center gap-6">
                <h2 class="text-[2rem]">Max</h2>
                <x-client.global.status isInCard="{{false}}">
                    {!! __('client/status.adoptable') !!}
                </x-client.global.status>
                <img src="{{asset('assets/icons/share.svg')}}" alt="{!! __('global.share') !!}">
            </div>
            <ul class="flex flex-col sx:grid sx:grid-cols-2 md:flex md:flex-col gap-4">
                @for($i = 0; $i <= 4; $i++)
                    <li class="flex items-center gap-2 w-1/2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$args[$i]}}
                        </x-client.global.icon_text>
                    </li>
                @endfor
            </ul>
            <article class="mb-8 md:mb-0">
                <h3 class="text-2xl mb-2">{!! __('client/animals.character_title') !!}</h3>
                <p>{!! __('client/animals.character') !!}</p>
            </article>
        </div>
        <div class="md:w-1/2 relative">
            <img src="{{asset('assets/images/max.jpg')}}"
                 alt="{!! __('client/animals.animal_image_alt', ['name' => 'Max']) !!}"
                 class="w-full h-full rounded-4xl">
            <div class="absolute w-[120%] top-[-5rem] right-[-3rem] sx:top-[-8rem] sx:right-[-9rem] sx:w-[140%] md:top-[-7rem] md:right-[-7rem] lg:top-[-12rem] lg:right-[-10rem] -z-20">
                <img src="{{asset('assets/icons/organic_1.svg')}}" alt="{!! __('global.organic_1_alt') !!}" class="w-full h-full">
            </div>
        </div>
    </div>
    <div class="mx-auto w-fit">
        <x-client.global.cta
            route="{{route('client_animal_request')}}"
            title="{!! __('client/animals.request_button_title', ['name' => 'Max']) !!}">
            {!! __('client/animals.request_button', ['name' => 'Max']) !!}
        </x-client.global.cta>
    </div>
</section>
