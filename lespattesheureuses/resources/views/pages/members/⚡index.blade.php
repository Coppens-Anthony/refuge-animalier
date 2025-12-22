<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tous les membres')]
class extends Component {

};
?>

<div class="grid grid-cols-10 gap-4">
    <div class="col-span-full ml-auto">
        <x-client.global.cta
            route="{{route('create.members')}}"
            title="{!! __('admin/members.create_member_title') !!}">
            {!!__('admin/members.create_member') !!}
        </x-client.global.cta>
    </div>
    <livewire:admin.members.members_table/>
</div>
