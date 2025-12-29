<?php

use App\Models\User;
use Livewire\Attributes\Computed;
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
        :member="$this->member"
    />
    @can('edit', $this->member)
    <div class="mx-auto">
            <x-client.global.cta
                wire:navigate="{{route('edit.members', $this->member->id)}}"
                route="{{route('edit.members', $this->member->id)}}"
                title="{{__('global.edit_title')}}"
            >
                {{__('global.edit')}}
            </x-client.global.cta>
        </div>
    @endcan
</div>
