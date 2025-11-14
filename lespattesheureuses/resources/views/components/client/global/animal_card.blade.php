@props(['image_src', 'image_alt', 'status', 'name', 'age', 'specie'])

<article class="flex flex-col relative gap-5.5 border-4 overflow-hidden bg-white border-primary rounded-3xl">
    <x-client.global.status>{{$status}}</x-client.global.status>
    <img src="{{$image_src}}" alt="{{$image_alt}}" class="border-primary">
    <div class="flex flex-col gap-2 w-[calc(100%-16px*2)] mx-auto">
        <h3 class="text-2xl">{{$name}}</h3>
        <p>{{$age}}</p>
        <p>{{$specie}}</p>
    </div>
    <div class="w-auto mx-auto mb-5.5">
        <x-client.global.button route="" title="">{!! __('global.see_me') !!}</x-client.global.button>
    </div>
</article>
