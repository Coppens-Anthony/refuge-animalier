<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<?php
$animals = [
    [
        'assets/images/max.jpg',
        'Tom',
        'Chien',
        'Adoptable',
    ],
    [
        'assets/images/max.jpg',
        'Tom',
        'Chien',
        'Adoptable',
    ],
    [
        'assets/images/max.jpg',
        'Tom',
        'Chien',
        'Adoptable',
    ],
    [
        'assets/images/max.jpg',
        'Tom',
        'Chien',
        'Adoptable',
    ],
    [
        'assets/images/max.jpg',
        'Tom',
        'Chien',
        'Adoptable',
    ],
]
?>


<div class="col-span-7 border-1 border-primary px-4 rounded-2xl">
    <section class="mb-4 flex flex-col gap-4">
        <div class="flex justify-between mt-4">
            <h3>{!! __('admin/global.animals') !!}</h3>
            <x-client.global.cta
                route=""
                title="{!! __('admin/global.create_animal_title') !!}"
            >
                {!! __('admin/global.create_animal') !!}
            </x-client.global.cta>
        </div>
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.specie'),__('admin/global.status')]"
            :datas="$animals"
        />
    </section>

</div>
