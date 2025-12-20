<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use App\Models\AdoptionNote;
use App\Models\Note;
use Carbon\Carbon;
use Livewire\Component;

new class extends Component {
    public Adoption $adoption;
    public string $note;

    public function store()
    {
        $validated = $this->validate([
            'note' => 'required'
        ]);

        $note = Note::create([
            'content' => $validated['note'],
            'user_id' => auth()->user()->id,
        ]);

        AdoptionNote::create([
            'adoption_id' => $this->adoption->id,
            'note_id' => $note->id
        ]);

        $this->note = '';

        $this->dispatch('close-modal');
    }

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
    <section class="mt-8 flex flex-col gap-4">
        <h3 class="text-2xl">Notes</h3>
        @if(!empty($this->adoption->notes))
            <ul class="flex flex-col gap-4">
                @foreach($this->adoption->notes as $note)
                    <li>{{$note->user->name}} ({{$note->formatDate('created_at')}}) : {{$note->content}}</li>
                @endforeach
            </ul>
        @else
            <p>Pas encore de note</p>
        @endif
        <div x-data="{open: false}"
             @close-modal.window="open = false"
             x-cloak>
            <button title="Ajouter une note pour l'adoption"
                    @click="open = true"
                    class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 cursor-pointer border-primary bg-white hover:bg-primary">
                Ajouter une note
            </button>
            <livewire:admin.global.modal>
                <form wire:submit="store">
                    <div class="flex flex-col gap-2">
                        <x-client.form.input
                            name="note"
                            wire:model="note"
                            placeholder="{{$this->adoption->adopter->name}} possède un jardin..."
                        >
                            Ajouter une note
                        </x-client.form.input>
                    </div>
                    <div class="flex gap-6 w-fit mt-5.5 ml-auto">
                        <p @click="open = false"
                           class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0    bg-white border-primary hover:bg-primary">
                            {{__('admin/global.close')}}
                        </p>
                        <x-client.global.button
                            title="{{__('admin/forms.edit_title')}}"
                        >
                            Ajouter
                        </x-client.global.button>
                    </div>
                </form>
            </livewire:admin.global.modal>
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
                {{$this->adoption->adopter->name}} {{__('admin/global.have_adopted')}} {{$this->adoption->animal->name}}
                &nbsp;!
            </x-client.global.button>
        </form>
    </div>
</div>
