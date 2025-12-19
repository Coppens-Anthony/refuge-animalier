<?php

use App\Enums\Adoptions;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public $datas;
};
?>

<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[ __('admin/global.animal_name'),__('admin/global.adopter_name'),__('admin/global.date'), __('admin/global.status'),]"
            :rows="$this->datas"
            :route="'show.adoptions'"
        />
    </section>
</div>
