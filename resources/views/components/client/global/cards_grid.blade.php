@php use Illuminate\Support\Facades\Storage; @endphp
@props(['isAnimal' => true, 'items'])

<ul class="mx-auto flex flex-col gap-4 sx:grid sx:grid-cols-2 md:grid md:grid-cols-3 md:gap-6 mb-6">
    @foreach($items as $item)
        @php
            $imageSrc = str_starts_with($item->avatar, 'public/assets/images/animals/')
                ? asset(str_replace('public/assets/', 'assets/', $item->avatar))
                : Storage::url('avatars/originals/'.$item->avatar);
        @endphp
        <li>
            <x-client.global.item_card
                :image_src="$imageSrc"
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
