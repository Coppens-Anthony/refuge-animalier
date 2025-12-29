@props(['title', 'desc', 'links' => false, 'image_src', 'image_alt'])

<section class="flex flex-col items-center md:flex-row gap-8 md:gap-15 lg:gap-30 mb-16 lg:mb-32">
    <div class="flex flex-col gap-2 md:w-2/3 lg:w-1/2">
        <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{{$title}}</h2>
        <p>{{$desc}}</p>
        @if($links)
            <div class="mt-6 flex flex-col sx:flex-row gap-8 justify-start">
                <x-client.global.cta route="{{route('client_animals')}}" title="{!! __('client/home.to_animals') !!}">{!! __('global.adopt') !!}</x-client.global.cta>
                <x-client.global.cta route="{{route('client_team')}}" reverse="{{true}}" title="{!! __('client/home.to_team') !!}">{!! __('client/header.our_team') !!}</x-client.global.cta>
            </div>
        @endif
    </div>
    <div class="md:w-1/2 relative">
        <img src="{{asset('assets/images/'.$image_src)}}}}"
             srcset="{{asset('assets/images/300x300/'.$image_src)}} 300w,
                     {{asset('assets/images/600x600/'.$image_src)}} 600w,
                        {{asset('assets/images/900x900/'.$image_src)}} 900w"
             sizes="(max-width: 768px) 100vw, 50vw"
             alt="{{$image_alt}}" class="w-full h-full rounded-4xl">
        <div class="absolute top-[-3rem] right-[-3rem] sx:top-[-8rem] sx:right-[-9rem] sx:w-[140%] md:top-[-7rem] md:right-[-7rem] lg:top-[-7rem] lg:right-[-7rem] -z-20 w-[130%]">
            <img src="{{asset('assets/icons/organic_1.svg')}}"
                 alt="{!! __('global.organic_1_alt') !!}" class="w-full h-full">
        </div>
    </div>
</section>


