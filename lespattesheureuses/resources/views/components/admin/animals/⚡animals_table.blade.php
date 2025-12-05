<?php

use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

new class extends Component {
    public Collection $datas;
};
?>

<?php
$rows = $datas->map(fn($data) => [
    'id' => $data->id,
    'cols' => [
        $data->avatar,
        $data->name,
        $data->specie->name,
        $data->breed->name,
        $data->sex,
        $data->status,
    ]]);
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
            :rows="$rows"
            :route="'show.animals'"
        />
    </section>
</div>
