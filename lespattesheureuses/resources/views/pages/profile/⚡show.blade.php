<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mon profil')]
class extends Component {
    #[Computed]
    public function authUser()
    {
        return auth()->user();
    }

};
?>

<div class="flex flex-col gap-8">
    <livewire:admin.global.hero_member
        :member="$this->authUser"
    />
    <livewire:admin.global.dispo
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
