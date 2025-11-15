@props(['number', 'image_src', 'image_alt', 'status', 'name', 'arg_1', 'arg_2', 'isAnimal' => true])

<ul class="w-2/3 mx-auto flex flex-col gap-4 md:w-auto  md:grid md:grid-cols-3 md:gap-5.5 mb-5.5">
    @for($i = 0; $i < $number; $i++)
        <li>
            <x-client.global.item_card
                image_src="{{$image_src}}"
                image_alt="{{$image_alt}}"
                status="{{$status}}"
                name="{{$name}}"
                arg_1="{{$arg_1}}"
                arg_2="{{$arg_2}}"
                isAnimal="{{$isAnimal}}"
            />
        </li>
    @endfor
</ul>
