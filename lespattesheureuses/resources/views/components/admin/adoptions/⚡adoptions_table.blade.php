<?php

use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    public Collection $datas;
};
?>
<?php
$rows = $datas->map(fn($data) => [
    'id' => $data->animal->id,
    'cols' => [
        $data->animal->avatar,
        $data->animal->name,
        $data->adopter->name,
        $data->adopter->email,
        $data->adopter->telephone,
        $data->adopter->created_at,
    ]]);
?>


<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <x-client.global.filters_bar.filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.animal_name'),__('admin/global.adopter_name'),__('admin/global.email'), __('admin/global.telephone'),__('admin/global.date')]"
            :rows="$rows"
            :route="'show.animals'"
        />
    </section>
</div>
