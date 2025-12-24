@props(['animals'])

<section class="flex flex-col gap-8">
    <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{!! __('client/animals.animals_title') !!}</h2>
    <x-client.global.filters_bar.filters/>
    <x-client.global.cards_grid :items="$animals"/>
    <x-client.global.pagination/>
</section>
