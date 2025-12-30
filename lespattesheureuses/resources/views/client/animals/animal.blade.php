<x-client.global.layout>
    <x-client.animals.show_animal
        :animal="$animal"
    />
    @if($suggestedAnimals->count() > 0)
        <x-client.home.animals
            title="{!! __('client/animals.others_animals_title') !!}"
            :items="$suggestedAnimals"
        />
    @endif
</x-client.global.layout>
