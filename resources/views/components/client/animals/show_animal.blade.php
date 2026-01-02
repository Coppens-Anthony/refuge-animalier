<section class="mb-32">
    <div class="flex flex-col md:flex-row md:gap-30 md:items-center mb-8">
        <div class="flex flex-col gap-8 md:w-1/2">
            <div class="flex items-center gap-6">
                <h2 class="text-[2rem]">{{$animal->name}}</h2>
                <x-client.global.status isInCard="{{false}}">
                    {{$animal->status->label()}}
                </x-client.global.status>
                <img src="{{asset('assets/icons/share.svg')}}" alt="{!! __('global.share') !!}">
            </div>
            <ul class="flex flex-col gap-4">
                <li class="flex items-center gap-2">
                    <x-client.global.icon_text
                        image_src="{{asset('assets/icons/paw.svg')}}"
                        image_alt="{!! __('global.paw_icon') !!}">
                        {{$animal->breed->name}}
                    </x-client.global.icon_text>
                </li>
                <li class="flex items-center gap-2">
                    <x-client.global.icon_text
                        image_src="{{asset('assets/icons/paw.svg')}}"
                        image_alt="{!! __('global.paw_icon') !!}">
                        {{$animal->age()}}
                    </x-client.global.icon_text>
                </li>
                <li class="flex items-center gap-2">
                    <x-client.global.icon_text
                        image_src="{{asset('assets/icons/paw.svg')}}"
                        image_alt="{!! __('global.paw_icon') !!}">
                        {{$animal->sex->label()}}
                    </x-client.global.icon_text>
                </li>
                <li class="flex items-center gap-2">
                    <x-client.global.icon_text
                        image_src="{{asset('assets/icons/paw.svg')}}"
                        image_alt="{!! __('global.paw_icon') !!}">
                        {!! __('admin/global.coats') !!} :
                        @foreach($animal->coat as $coat)
                            {{$coat->name}},
                        @endforeach
                    </x-client.global.icon_text>
                </li>
                <li class="flex items-center gap-2">
                    <x-client.global.icon_text
                        image_src="{{asset('assets/icons/paw.svg')}}"
                        image_alt="{!! __('global.paw_icon') !!}">
                        {!! __('admin/global.vaccines') !!} :
                        @foreach($animal->vaccine as $vaccine)
                            {{$vaccine->name}},
                        @endforeach
                    </x-client.global.icon_text>
                </li>
            </ul>
            <article class="mb-8 md:mb-0">
                <h3 class="text-2xl mb-2">{!! __('client/animals.character_title') !!}</h3>
                <p>{{$animal->temperament}}</p>
            </article>
        </div>
        <div class="md:w-1/2 aspect-square">
            @if(str_starts_with($animal->avatar, 'public/assets/images/animals/'))
                <img src="{{asset(str_replace('public/assets/', 'assets/', $animal->avatar))}}"
                     alt="Photo de {{$animal->name}}"
                     class="w-full h-full rounded-4xl object-cover">
            @else
                <img src="{{Storage::url('avatars/originals/'.$animal->avatar)}}"
                     srcset="
                        {{Storage::url('avatars/variants/300x300/'.$animal->avatar)}} 300w,
                        {{Storage::url('avatars/variants/600x600/'.$animal->avatar)}} 600w,
                        {{Storage::url('avatars/variants/900x900/'.$animal->avatar)}} 900w"
                     sizes="(max-width: 768px) 100vw, 50vw"
                     alt="{!! __('client/animals.animal_image_alt', ['name' => $animal->name]) !!}"
                     class="w-full h-full rounded-4xl object-cover">
            @endif
        </div>
    </div>
    <div class="mx-auto w-fit">
        <x-client.global.cta
            route="{{route('client_animal_request', ['animal' => $animal->id])}}"
            title="{!! __('client/animals.request_button_title', ['name' => $animal->name]) !!}">
            {!! __('client/animals.request_button', ['name' => $animal->name]) !!}
        </x-client.global.cta>
    </div>
</section>
