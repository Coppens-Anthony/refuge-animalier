@php use Illuminate\Support\Facades\Storage; @endphp
<section class="flex flex-col justify-center">
    <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium mb-8">{!! __('client/team.team_title') !!}</h2>
    <ul class="mx-auto flex flex-col gap-4 sx:grid sx:grid-cols-2 md:grid md:grid-cols-3 md:gap-6 mb-6">
        @foreach($items as $item)
            @php
                $imageSrc = str_starts_with($item->avatar, 'public/assets/images/')
                    ? asset(str_replace('public/assets/', 'assets/', $item->avatar))
                    : Storage::url('avatars/originals/'.$item->avatar);
            @endphp
            <li>
                <x-client.global.item_card
                    :image_src="$imageSrc"
                    :image_alt="__('client/animals.animal_image_alt', ['name' => $item->name])"
                    :status="$item->status->label()"
                    :name="$item->name"
                    :arg_1="$item->email"
                    :arg_2="$item->telephone"
                    :id="$item->id"
                    :is-animal="false"
                />
            </li>
        @endforeach
    </ul>
    <div class="mx-auto mt-8">
        <x-client.global.cta
            route="{{route('client_contact')}}"
            title="{!! __('client/team.join_us_title') !!}">
            {!! __('client/team.join_us') !!}
        </x-client.global.cta>
    </div>

</section>
