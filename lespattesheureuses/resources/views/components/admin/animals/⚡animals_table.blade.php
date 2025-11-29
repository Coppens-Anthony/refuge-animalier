<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<?php


$animals = [];

for ($i = 1; $i <= 10; $i++) {
    $animals[] = [
        "assets/images/max.jpg",
        "Tom",
        'Chien',
        'Berger allemand',
        'Mâle',
        'Adoptable',
    ];
}
?>


<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <div class="flex justify-end mt-4">
            <h3 class="sr-only">
                {!!__('admin/global.animals') !!}</h3>
            <x-client.global.cta
                route="{{route('create.animals')}}"
                title="{!! __('admin/global.create_animal_title') !!}"
            >
                {!!__('admin/global.create_animal') !!}
            </x-client.global.cta>
        </div>
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.specie'),__('admin/global.breed'), __('admin/global.sex'),__('admin/global.status')]"
            :datas="$animals"
        />
    </section>
</div>
