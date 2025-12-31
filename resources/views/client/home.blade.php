@props(['title'])

<x-client.global.layout>
    <x-client.global.basic_section
        title="{!! __('client/home.intro_title') !!}"
        desc="{!! __('client/home.intro_desc') !!}"
        links="{{true}}"
        image_src="home_intro.jpg"
        image_alt="{!! __('client/home.intro_image_alt') !!}"
    />
    <div class="flex flex-col gap-16">
        <x-client.home.stats_section
            :animals="$animals"
            :adoptions="$adoptions"
            :animalsAdoptable="$animalsAdoptable"
        />
        @if($lastAnimals->count() > 0)
            <x-client.home.animals
                title="{!! __('client/home.animals_title') !!}"
                :items="$lastAnimals"
            />
        @endif
        <x-client.home.contact_section/>
    </div>
</x-client.global.layout>
