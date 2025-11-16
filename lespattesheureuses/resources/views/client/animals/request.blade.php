@php
    $args = [
        '3 ans',
        'Berger allemand',
        'Mâle',
        'Pelage feu',
        'Pas de vaccin'
    ];
@endphp

<x-client.global.layout>
    <div class="flex flex-col gap-8 md:flex-row md:items-start md:gap-15 lg:gap-30">
        <section class="flex flex-col gap-6 md:w-1/2">
            <h2 class="text-[2rem]">Max</h2>
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
            <img src="{{asset('assets/images/max.jpg')}}"
                 alt="{!! __('client/animals.animal_image_alt', ['name' => 'Max']) !!}"
                 class="w-full h-full rounded-4xl">
        </section>
        <x-client.contact.form
            action=""
            isSubject="{{false}}"
            button_title="{!! __('form.send_request_title') !!}"
        >
            {!! __('form.send_request') !!}
        </x-client.contact.form>
    </div>
</x-client.global.layout>
