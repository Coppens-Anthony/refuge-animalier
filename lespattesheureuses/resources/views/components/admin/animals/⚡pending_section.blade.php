<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use Livewire\Component;

new class extends Component {
    public Adoption $animalAdoption;

    public function destroy()
    {
        $this->animalAdoption->delete();

        return redirect(route('index.adoptions'));
    }

    public function update()
    {
        $this->animalAdoption->update([
            'status' => Adoptions::IN_PROGRESS
        ]);

        return redirect(route('index.adoptions'));
    }
};
?>

<div>
    <section>
        <div class="flex flex-col gap-8">
            <h3 class="text-[2rem]">{{$this->animalAdoption->adopter->name}}</h3>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/email.svg')}}" alt="{!! __('global.email_icon') !!}">
                    <a href="mailto:{{$this->animalAdoption->adopter->email}}"
                       {!! __('global.email_title') !!} class="link">{{$this->animalAdoption->adopter->email}}</a>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/telephone.svg')}}" alt="{!! __('global.telephone_icon') !!}">
                    <a href="tel:{{$this->animalAdoption->adopter->telephone}}"
                       {!! __('global.telephone_title') !!} class="link">{{$this->animalAdoption->adopter->telephone}}</a>
                </div>
            </div>
        </div>
    </section>
    <div class="flex gap-4 w-fit mx-auto">
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
</div>
