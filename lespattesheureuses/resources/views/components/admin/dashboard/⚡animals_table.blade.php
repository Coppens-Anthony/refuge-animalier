<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<?php
$animals = [
    [
        'avatar' => 'assets/images/max.jpg',
        'name' => 'Tom',
        'specie' => 'Chien',
        'status' => 'Adoptable',
    ],
    [
        'avatar' => 'assets/images/max.jpg',
        'name' => 'Tom',
        'specie' => 'Chien',
        'status' => 'Adoptable',
    ],
    [
        'avatar' => 'assets/images/max.jpg',
        'name' => 'Tom',
        'specie' => 'Chien',
        'status' => 'Adoptable',
    ],
    [
        'avatar' => 'assets/images/max.jpg',
        'name' => 'Tom',
        'specie' => 'Chien',
        'status' => 'Adoptable',
    ],
    [
        'avatar' => 'assets/images/max.jpg',
        'name' => 'Tom',
        'specie' => 'Chien',
        'status' => 'Adoptable',
    ],
]
?>


<div class="col-span-7 border-1 border-primary px-4 rounded-2xl">
    <section class="mb-4 flex flex-col gap-4">
        <div class="flex justify-between my-4">
            <h2>{!! __('admin/dashboard.animals') !!}</h2>
            <x-client.global.cta
                route=""
                title="{!! __('admin/dashboard.create_animal_title') !!}"
            >
                {!! __('admin/dashboard.create_animal') !!}
            </x-client.global.cta>
        </div>
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/dashboard.avatar'), __('admin/dashboard.name'),__('admin/dashboard.specie'),__('admin/dashboard.status')]"
            :datas="$animals"
        />
    </section>

</div>
