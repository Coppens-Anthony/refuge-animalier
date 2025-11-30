<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mon profil')]
class extends Component {
};
?>

<div class="flex flex-col gap-8">
    <livewire:admin.profile.hero/>
    <livewire:admin.profile.dispo
        dispo_title="{{__('admin/dispo.my_dispo')}}"
    />
    <div class="mx-auto">
        <x-client.global.cta
            route=""
            title="{{__('global.edit_title')}}"
        >
            {{__('global.edit')}}
        </x-client.global.cta>
    </div>
</div>
