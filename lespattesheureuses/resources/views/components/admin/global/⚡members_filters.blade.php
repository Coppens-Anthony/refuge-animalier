<?php

use Livewire\Component;

new class extends Component
{
};
?>

<div>
    <form action="" method="post" class="grid grid-cols-2 gap-4 mb-4">
        <x-client.form.input
            type="search"
            name="search"
            placeholder="John"
            isRequired="{{false}}"
            isSearch="{{true}}"
            class="col-span-2 md:col-span-1">
            {!! __('global.search') !!}
        </x-client.form.input>
        <div class="flex justify-between col-span-2 gap-4 md:col-span-1">
            <x-client.form.select
                name="role"
                class="w-full"
                isRequired="{{false}}"
                :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => 'admin', 'trad' => __('admin/global.admin')],
    ['value' => 'volunteer', 'trad' => __('admin/global.volunteer')],
]">
                {!! __('admin/members.role') !!}
            </x-client.form.select>
        </div>
    </form>

</div>
