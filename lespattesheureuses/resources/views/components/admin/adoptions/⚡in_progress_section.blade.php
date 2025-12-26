<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use App\Models\AdoptionNote;
use App\Models\Note;
use Carbon\Carbon;
use Livewire\Component;

new class extends Component {
    public Adoption $adoption;

    public function destroy()
    {
        $this->adoption->delete();
        session()->flash('delete', __('admin/global.adoption_cancelled'));
        return redirect(route('index.adoptions'));
    }

    public function update()
    {
        $this->adoption->update([
            'status' => Adoptions::FINISHED,
            'date' => Carbon::now()
        ]);

        session()->flash('success', __('admin/global.adoption_finished'));
        return redirect(route('show.adoptions', $this->adoption));
    }
};
?>

<div>

    <div class="flex flex-col md:flex-row gap-4 w-fit mx-auto mt-8">
        <form wire:submit="destroy">
            <x-client.global.button
                isDangerous="{{true}}"
                title="{{__('admin/forms.deny_adoption_request')}}">
                {{__('admin/global.stop_adoption')}} {{$this->adoption->animal->name}}
            </x-client.global.button>
        </form>
        <form wire:submit="update">
            <x-client.global.button
                title="{{__('admin/forms.accept_adoption_request')}}">
                {{$this->adoption->adopter->name}} {{__('admin/global.have_adopted')}} {{$this->adoption->animal->name}}&nbsp;!
            </x-client.global.button>
        </form>
    </div>
</div>
