<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<?php


$requests = [];

for ($i = 1; $i <= 10; $i++) {
    $requests[] = [
        'assets/images/max.jpg',
        'Tom',
        'John Doe',
        'john@doe.com',
        '0123.45.67.89',
        '25-02-25',
    ];
}
?>


<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.animal_name'),__('admin/global.adopter_name'),__('admin/global.email'), __('admin/global.telephone'),__('admin/global.date')]"
            :datas="$requests"
        />
    </section>
</div>
