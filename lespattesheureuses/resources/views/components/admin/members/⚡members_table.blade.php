<?php

use Livewire\Component;

new class extends Component {
    //
};
?>
<?php


$members = [];

for ($i = 1; $i <= 10; $i++) {
    $members[] = [
        "assets/images/johndoe.jpg",
        "John Doe",
        'john@doe.com',
        '0123.45.67.89',
        'Bénévole',
    ];
}
?>


<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <div class="flex justify-end mt-4">
            <h3 class="sr-only">
                {!!__('admin/members.members') !!}</h3>
            <x-client.global.cta
                route=""
                title="{!! __('admin/members.create_member_title') !!}"
            >
                {!!__('admin/members.create_member') !!}
            </x-client.global.cta>
        </div>
        <livewire:admin.global.members_filters/>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.email'),__('admin/global.telephone'), __('admin/global.status')]"
            :datas="$members"
        />
    </section>
</div>
