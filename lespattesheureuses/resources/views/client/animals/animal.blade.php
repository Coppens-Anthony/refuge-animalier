<x-client.global.layout>
    <x-client.animals.show_animal
        :animal="$animal"
    />
    <x-client.home.animals
        title="{!! __('client/animals.others_animals_title') !!}"
        :items="$suggestedAnimals"
    />
</x-client.global.layout>
