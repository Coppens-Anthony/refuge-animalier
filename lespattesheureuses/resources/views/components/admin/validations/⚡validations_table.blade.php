<?php

use Livewire\Component;

new class extends Component {
    public $datas;
};
?>

<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.specie'),__('admin/global.breed'), __('admin/global.sex'), __('admin/global.age')]"
            :rows="$this->datas"
            :route="'edit.animals'"
        />
    </section>
</div>
