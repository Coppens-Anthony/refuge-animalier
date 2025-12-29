<x-client.global.layout>
    <x-client.global.basic_section
        title="{!! __('client/animals.intro_title') !!}"
        desc="{!! __('client/animals.intro_desc') !!}"
        image_src="animals_intro.jpg"
        image_alt="{!! __('client/animals.intro_image_alt') !!}"
    />

    <x-client.animals.animals :species="$species" :breeds="$breeds" :coats="$coats" :animals="$animals"/>
</x-client.global.layout>
