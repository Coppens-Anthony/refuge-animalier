<x-client.global.layout>
    <x-client.global.basic_section
        title="{!! __('client/animals.intro_title') !!}"
        desc="{!! __('client/animals.intro_desc') !!}"
        image_src="{{asset('assets/images/animals_intro.png')}}"
        image_alt="{!! __('client/animals.intro_image_alt') !!}"
    />

    <x-client.animals.animals/>
</x-client.global.layout>
