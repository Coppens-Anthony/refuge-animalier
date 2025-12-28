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
    public string $editNote;
    public ?int $editingId = null;

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

    public function edit(Note $note)
    {
        $this->editNote = $note->content;
        $this->editingId = $note->id;
    }

    public function update()
    {
        $validated = $this->validate([
            'editNote' => 'required',
        ]);

        $note = Note::findOrFail($this->editingId);
        $note->update(['content' => $validated['editNote']]);

        $this->dispatch('note-edited');
    }

    public function delete($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
    }
};
?>

<div>
    <section class="mt-8 flex flex-col gap-4">
        <h3 class="text-2xl">{{__('admin/global.notes')}}</h3>
        @if($this->adoption->notes->count() > 0)
            <ul class="flex flex-col gap-4">
                @foreach($this->adoption->notes as $note)
                    <li class="flex gap-4 items-start" x-data="{edit: false}">
                        <p>{{$note->user->firstname . ' ' . $note->user->lastname}} ({{$note->formatDate('created_at')}}) : {{$note->content}}</p>
                        <div class="flex gap-2">
                            <img src="{{asset('assets/icons/edit.svg')}}"
                                 alt="{{__('global.edit_icon')}}"
                                 class="cursor-pointer w-6 h-6"
                                 wire:click="edit({{$note}})"
                                 @click="edit = true">
                            <form wire:submit="delete({{$note->id}})">
                                <button type="submit" class="cursor-pointer w-6 h-6">
                                    <img src="{{asset('assets/icons/delete.svg')}}"
                                         alt="{{__('global.delete_icon')}}"
                                    >
                                </button>
                            </form>
                        </div>
                        <div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="edit"></div>
                        <div x-show="edit" x-cloak x-on:note-edited.window="edit = false" @click.outside="edit = false"
                             @keydown.escape.window="edit = false"
                             class="p-6 fixed w-3/4 md:w-[50vw] z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
                            <div class="absolute z-60 cursor-pointer top-2 right-2" @click="edit = false">
                                <svg viewBox="0 0 24 24" fill="black" width="40" height="40"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M16 8L8 16M8.00001 8L16 16" stroke="#000000" stroke-width="1.5"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <form wire:submit="update">
                                <x-client.form.textarea
                                    rows="3"
                                    wire:model.live="editNote"
                                    name="editNote"
                                    placeholder="{{$note->content}}"
                                >
                                    {{__('admin/forms.note_edit')}}
                                </x-client.form.textarea>
                                <div class="flex gap-6 w-fit mt-5.5 ml-auto">
                                    <p @click="edit = false"
                                       class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                                        {{__('admin/global.close')}}
                                    </p>
                                    <x-client.global.button
                                        title="{{__('admin/forms.edit_title')}}">
                                        {{__('admin/forms.edit')}}
                                    </x-client.global.button>
                                </div>
                            </form>
                        </div>
                    </li>
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
                        <x-client.form.textarea
                            rows="3"
                            name="note"
                            wire:model="note"
                            placeholder="{{__('admin/global.note_placeholder', ['name' => $this->adoption->adopter->name])}}"
                        >
                            {{__('admin/global.add_note')}}
                        </x-client.form.textarea>
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
