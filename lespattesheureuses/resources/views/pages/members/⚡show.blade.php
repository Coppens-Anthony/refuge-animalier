<?php

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Profil de ')]
class extends Component {
    public User $member;

};
?>
<div class="flex flex-col gap-8">
    <livewire:admin.global.hero_member
        :member="$this->member"
    />
    <livewire:admin.global.dispo
        dispo_title="{{__('admin/dispo.his_dispo')}}"
    />
</div>
