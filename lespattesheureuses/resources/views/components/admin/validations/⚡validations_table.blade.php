<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<?php


$validations = [];

for ($i = 1; $i <= 10; $i++) {
    $validations[] = [
        "assets/images/max.jpg",
        "Tom",
        'Chien',
        'Berger allemand',
        'Mâle',
        '2 ans'
    ];
}
?>


<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.specie'),__('admin/global.breed'), __('admin/global.sex'), __('admin/global.age')]"
            :datas="$validations"
        />
    </section>
</div>
