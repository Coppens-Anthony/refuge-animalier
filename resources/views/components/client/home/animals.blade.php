@props(['title', 'items', 'isAnimal' => true])

<section class="relative">
    <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium mb-8">{{$title}}</h2>
    <ul class="mx-auto flex flex-col gap-4 sx:grid sx:grid-cols-2 md:grid md:grid-cols-3 md:gap-6 mb-6">
        @foreach($items as $item)
            <li>
                <x-client.global.item_card
                    :image_src="Storage::disk('s3')->url('avatars/originals/'.$item->avatar)"
                    :image_alt="__('client/animals.animal_image_alt', ['name' => $item->name])"
                    :status="$item->status"
                    :name="$item->name"
                    :arg_1="$item->age()"
                    :arg_2="$item->breed->name"
                    :isAnimal="$isAnimal"
                    :id="$item->id"
                />
            </li>
        @endforeach
    </ul>
    <div class="absolute top-[50%] right-[-2rem] w-[130%] -z-20
    sx:w-[115%]
    md:top-[15%]
    lg:right-[-4rem]">
        <img src="{{asset('assets/icons/organic_2.svg')}}" alt="{!! __('global.organic_1_alt') !!}"
             class="w-full h-full">
    </div>
    <div class="w-fit mx-auto">
        <x-client.global.cta route="{{route('client_animals')}}"
                             title="{!! __('client/home.to_animals') !!}">{!! __('client/home.all_animals') !!}</x-client.global.cta>
    </div>
</section>
