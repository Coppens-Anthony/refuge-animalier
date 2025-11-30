<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Profil de John Doe')]
class extends Component {
};
?>

<div class="flex flex-col gap-8">
    <livewire:admin.global.hero_member/>
    <livewire:admin.global.dispo
        dispo_title="{{__('admin/dispo.his_dispo')}}"
    />
</div>
