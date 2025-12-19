<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
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
    <section>
        <div class="flex flex-col gap-8">
            <h3 class="text-[2rem]">{{$this->adoption->adopter->name}}</h3>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/email.svg')}}" alt="{!! __('global.email_icon') !!}">
                    <a href="mailto:{{$this->adoption->adopter->email}}"
                       {!! __('global.email_title') !!} class="link">{{$this->adoption->adopter->email}}</a>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/telephone.svg')}}" alt="{!! __('global.telephone_icon') !!}">
                    <a href="tel:{{$this->adoption->adopter->telephone}}"
                       {!! __('global.telephone_title') !!} class="link">{{$this->adoption->adopter->telephone}}</a>
                </div>
            </div>
        </div>
    </section>
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
</div>
