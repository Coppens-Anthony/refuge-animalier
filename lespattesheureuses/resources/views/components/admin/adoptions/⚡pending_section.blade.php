<?php

use App\Enums\Adoptions;
use App\Mail\AdoptionAccepted;
use App\Mail\AdoptionDenied;
use App\Models\Adoption;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;

new class extends Component {
    public Adoption $adoption;

    public function destroy()
    {
        $this->adoption->delete();

        Mail::to($this->adoption->adopter->email)->send(
            new AdoptionDenied($this->adoption)
        );

        session()->flash('delete', __('admin/global.adoption_deny'));
        return redirect(route('index.adoptions'));
    }

    public function update()
    {
        $this->adoption->update([
            'status' => Adoptions::IN_PROGRESS
        ]);

        Mail::to($this->adoption->adopter->email)->queue(
            new AdoptionAccepted($this->adoption)
        );

        session()->flash('success', __('admin/global.adoption_accepted'));
        return redirect(route('show.adoptions', $this->adoption));
    }
};
?>

<div>
    @can('view-any', User::class)
        <div class="flex gap-4 w-fit mx-auto mt-8" x-data="{deleteModal: false}" x-cloak>
            <x-client.global.button
                :is-dangerous="true"
                type="button"
                title="{!!__('admin/forms.deny_adoption_request')!!}"
                @click="deleteModal = true"
            >
                {!!__('admin/forms.deny')!!}
            </x-client.global.button>

            <livewire:admin.global.modal modalName="deleteModal">
                <p class="my-4">
                    {!!__('admin/global.confirm_delete', ['category' => 'la demande d\'adoption', 'name' => $this->adoption->adopter->name])!!}
                </p>
                <div class="flex flex-col md:flex-row gap-6 w-fit mt-5.5 ml-auto">
                    <button @click="deleteModal = false"
                            class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                        {!!__('admin/global.close')!!}
                    </button>
                    <form wire:submit="destroy" @submit="deleteModal = false">
                        <x-client.global.button
                            title="{!!__('admin/forms.deny_adoption_request')!!}"
                            :is-dangerous="true"
                        >
                            {!!__('admin/forms.deny')!!}
                        </x-client.global.button>
                    </form>
                </div>
            </livewire:admin.global.modal>
            <form wire:submit="update">
                <x-client.global.button
                    title="{!!__('admin/forms.accept_adoption_request')!!}">
                    {!!__('admin/forms.accept')!!}
                </x-client.global.button>
            </form>
        </div>
    @endcan
</div>
