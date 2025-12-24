<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use App\Models\User;
use Livewire\Component;

new class extends Component {
    public Adoption $adoption;

    public function destroy()
    {
        $this->adoption->delete();

        return redirect(route('index.adoptions'));
    }

    public function update()
    {
        $this->adoption->update([
            'status' => Adoptions::IN_PROGRESS
        ]);

        return redirect(route('show.adoptions', $this->adoption));
    }
};
?>

<div>
    @can('view-any', User::class)
        <div class="flex gap-4 w-fit mx-auto mt-8">
            <form wire:submit="destroy">
                <x-client.global.button
                    isDangerous="{{true}}"
                    title="{{__('admin/forms.deny_adoption_request')}}">
                    {{__('admin/forms.deny')}}
                </x-client.global.button>
            </form>
            <form wire:submit="update">
                <x-client.global.button
                    title="{{__('admin/forms.accept_adoption_request')}}">
                    {{__('admin/forms.accept')}}
                </x-client.global.button>
            </form>
        </div>
    @endcan
</div>
