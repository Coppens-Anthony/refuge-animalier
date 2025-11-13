@props(['title', 'desc', 'links' => false, 'image_src', 'image_alt'])

<section class="flex flex-col items-center lg:flex-row gap-8 lg:gap-30 mb-16 lg:mb-32">
    <div class="flex flex-col gap-2 lg:w-1/2">
        <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{{$title}}</h2>
        <p class="font-nunito">{{$desc}}</p>
        @if($links)
            <div class="mt-6 flex gap-8 justify-center lg:justify-start">
                <x-button route="">{!! __('global.adopt') !!}</x-button>
                <x-button route="" reverse="{{true}}">{!! __('client/header.our_team') !!}</x-button>
            </div>
        @endif
    </div>
    <div class="lg:w-1/2 relative">
        <img src="{{$image_src}}" alt="{{$image_alt}}" class="w-full h-full rounded-4xl">
    </div>
</section>


