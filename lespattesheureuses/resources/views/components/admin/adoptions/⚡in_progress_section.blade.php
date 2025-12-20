<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use Carbon\Carbon;
use Livewire\Component;

new class extends Component {
    public Adoption $adoption;

    public function destroy()
    {
        $this->adoption->delete();

        return redirect(route('index.animals'));
    }

    public function update()
    {
        $this->adoption->update([
            'status' => Adoptions::FINISHED,
            'date' => Carbon::now()
        ]);

        return redirect(route('show.adoptions', $this->adoption));
    }
};
?>

<div>
    <section class="flex gap-30">
        <div class="flex flex-col gap-8 w-1/2">
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
        <div class="w-1/2">
            <p class="text-2xl mb-2">Son message</p>
            <p>{{$this->adoption->message}}</p>
        </div>
    </section>
    <div class="flex gap-4 w-fit mx-auto mt-8">
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
