<?php

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
        $data->email,
        $data->telephone,
        $data->status,
    ]
])
?>


<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <h3 class="sr-only">
            {!!__('admin/members.members') !!}</h3>
        <livewire:admin.global.members_filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.email'),__('admin/global.telephone'), __('admin/global.status')]"
            :rows="$rows"
            :route="'show.members'"
        />
    </section>
</div>
