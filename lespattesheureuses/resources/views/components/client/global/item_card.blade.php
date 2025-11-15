@props(['image_src', 'image_alt', 'status', 'name', 'arg_1', 'arg_2', 'isAnimal' => true])

<article class="flex flex-col relative gap-5.5 border-4 overflow-hidden bg-white border-primary rounded-3xl">
    <x-client.global.status>{{$status}}</x-client.global.status>
    <img src="{{$image_src}}" alt="{{$image_alt}}" class="border-primary">
    <div class="flex flex-col gap-2 w-[calc(100%-16px*2)] mx-auto">
        <h3 class="text-2xl">{{$name}}</h3>
        <p>{{$arg_1}}</p>
        <p>{{$arg_2}}</p>
    </div>
    <div class="w-auto mx-auto {{$isAnimal ? 'mb-5.5' : ''}}">
        @if($isAnimal)
            <x-client.global.button route="" title="{!! __('client/animals.see_me', ['name' => $name]) !!}">{!! __('global.see_me') !!}</x-client.global.button>
        @endif
    </div>
</article>
