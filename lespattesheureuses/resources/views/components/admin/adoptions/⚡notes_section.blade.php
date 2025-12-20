<?php

use App\Enums\Adoptions;
use App\Enums\Status;
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
};
?>

<div>
    <section class="mt-8 flex flex-col gap-4">
        <h3 class="text-2xl">{{__('admin/global.notes')}}</h3>
        @if($this->adoption->notes->count() > 0)
            <ul class="flex flex-col gap-4">
                @foreach($this->adoption->notes as $note)
                    <li>{{$note->user->name}} ({{$note->formatDate('created_at')}}) : {{$note->content}}</li>
                @endforeach
            </ul>
        @else
            <p>{{__('admin/global.no_notes')}}</p>
        @endif
        <div x-data="{open: false}"
             @close-modal.window="open = false"
             x-cloak>
            <button title="{{__('admin/global.add_note')}}"
                    @click="open = true"
                    class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 cursor-pointer border-primary bg-white hover:bg-primary">
                {{__('admin/global.add_note')}}
            </button>
            <livewire:admin.global.modal>
                <form wire:submit="store">
                    <div class="flex flex-col gap-2">
                        <x-client.form.input
                            name="note"
                            wire:model="note"
                            placeholder="{{__('admin/global.note_placeholder', ['name' => $this->adoption->adopter->name])}}"
                        >
                            {{__('admin/global.add_note')}}
                        </x-client.form.input>
                    </div>
                    <div class="flex gap-6 w-fit mt-5.5 ml-auto">
                        <p @click="open = false"
                           class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0    bg-white border-primary hover:bg-primary">
                            {{__('admin/global.close')}}
                        </p>
                        <x-client.global.button
                            title="{{__('admin/global.add_note')}}"
                        >
                            {{__('admin/forms.add')}}
                        </x-client.global.button>
                    </div>
                </form>
            </livewire:admin.global.modal>
        </div>
    </section>
</div>
