@props(['animals', 'species', 'breeds', 'coats'])

<section class="flex flex-col gap-8">
    <h2 class="text-[1.125rem] md:text-[1.5rem] lg:text-[2rem] font-bold lg:font-medium">{!! __('client/animals.animals_title') !!}</h2>
    <x-client.global.filters_bar.filters
        :species="$species" :breeds="$breeds" :coats="$coats" :animals="$animals"
    />
    @if($animals->count() > 0)
        <x-client.global.cards_grid :items="$animals"/>
    @else
        <p class="mx-auto my-8">Aucun élément correspondant à votre recherche</p>
    @endif

    {{$animals->links()}}
</section>
