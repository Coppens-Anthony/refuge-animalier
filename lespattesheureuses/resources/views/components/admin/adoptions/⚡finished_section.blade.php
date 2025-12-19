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

        return redirect(route('index.adoptions'));
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
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/calendar.svg')}}" alt="{!! __('global.telephone_icon') !!}">
                    <p>Adopté le {{$this->adoption->formatDate()}}</p>
                </div>
            </div>
        </div>
    </section>
    <div class="flex gap-4 w-fit mx-auto mt-8">
        <form wire:submit="update">
            <x-client.global.button
                isDangerous="{{true}}"
                title="{{__('admin/forms.deny_adoption_request')}}">
                Réintégrer au refuge en archivant l'adoption
            </x-client.global.button>
        </form>
    </div>
</div>
