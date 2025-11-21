@props(['number', 'image_src', 'image_alt', 'status', 'name', 'arg_1', 'arg_2', 'isAnimal' => true])

<ul class="mx-auto flex flex-col gap-4 md:w-auto sx:grid sx:grid-cols-2 md:grid-cols-3 md:gap-6 mb-6">
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
