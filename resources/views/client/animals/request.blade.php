<x-client.global.layout>
    <div class="flex flex-col gap-8 md:flex-row md:items-start md:gap-15 lg:gap-30">
        <section class="flex flex-col gap-6 md:w-1/2">
            <h2 class="text-[2rem]">{{$animal->name}}</h2>
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
                        {!! __('admin/global.coats')!!} :
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
            <div class="aspect-square">
                <img
                    src="{{Storage::disk('s3')->url('avatars/originals/'.$animal->avatar)}}"
                    srcset="
                        {{Storage::disk('s3')->url('avatars/variants/300x300/'.$animal->avatar)}} 300w,
                        {{Storage::disk('s3')->url('avatars/variants/600x600/'.$animal->avatar)}} 600w,
                        {{Storage::disk('s3')->url('avatars/variants/900x900/'.$animal->avatar)}} 900w"
                    sizes="(max-width: 768px) 100vw, 50vw"
                    alt="{!! __('client/animals.animal_image_alt', ['name' => $animal->name]) !!}"
                    class="w-full h-full rounded-4xl object-cover">
            </div>
        </section>
        <x-client.contact.form
            action="{{route('client_animal_request.store', ['animal' => $animal->id])}}"
            isSubject="{{false}}"
            button_title="{!! __('form.send_request_title') !!}"
        >
            {!! __('form.send_request') !!}
        </x-client.contact.form>
    </div>
</x-client.global.layout>
