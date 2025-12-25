<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adoption;
use Carbon\Carbon;
use Livewire\Component;

new class extends Component {
    public Adoption $adoption;

    public function update()
    {
        $this->adoption->update([
            'status' => Adoptions::ARCHIVED,
        ]);

        $this->adoption->animal->update([
            'status' => Status::ADOPTABLE
        ]);

        session()->flash('delete', __('admin/global.adoption_archived'));
        return redirect(route('show.adoptions', $this->adoption));
    }
};
?>

<div>
    <div class="flex gap-4 w-fit mx-auto mt-8">
        <form wire:submit="update">
            <x-client.global.button
                isDangerous="{{true}}"
                title="{{__('admin/forms.deny_adoption_request')}}">
                {{__('admin/global.archived_adoption')}}
            </x-client.global.button>
        </form>
    </div>
</div>
