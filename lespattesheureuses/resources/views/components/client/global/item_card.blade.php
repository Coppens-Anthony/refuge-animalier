@props(['image_src', 'image_alt', 'status', 'name', 'arg_1', 'arg_2', 'isAnimal' => true, 'id'])

<article class="flex flex-col relative gap-6 border-4 overflow-hidden bg-white border-primary rounded-3xl">
    <x-client.global.status>{{ $status }}</x-client.global.status>

    <div class="aspect-square">
        <img src="{{ $image_src }}"
             srcset="{{ $image_src }} 300w,
                     {{ $image_src }} 600w,
                     {{ $image_src }} 900w,
                     {{ $image_src }} 1200w"
             sizes="(max-width: 768px) 100vw, 50vw"
             alt="{{ $image_alt }}"
             class="h-full w-full object-cover border-primary">
    </div>

    <div class="flex flex-col gap-2 w-[calc(100%-16px*2)] mx-auto">
        <h3 class="text-2xl">{{ $name }}</h3>
        <p>{{ $arg_1 }}</p>
        <p>{{ $arg_2 }}</p>
    </div>

    <div class="w-auto mx-auto {{ $isAnimal ? 'mb-6' : '' }}">
        @if($isAnimal)
            <x-client.global.cta
                route="{{ route('client_animal', ['animal' => $id]) }}"
                title="{!! __('client/animals.see_me', ['name' => $name]) !!}">
                {!! __('global.see_me') !!}
            </x-client.global.cta>
        @endif
    </div>
</article>
