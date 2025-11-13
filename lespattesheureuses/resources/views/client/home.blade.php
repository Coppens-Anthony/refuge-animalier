@props(['title'])

<x-client.layout/>
<x-client.intro_page
    title="{!! __('client/home.intro_title') !!}"
    desc="{!! __('client/home.intro_desc') !!}"
    links="{{true}}"
    image_src="{{ asset('assets/images/home_intro.png') }}"
    image_alt="{!! __('client/home.image_alt') !!}"
/>
<div class="flex flex-col gap-16">
    <x-client.home.stats_section/>
</div>

