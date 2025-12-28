<?php

use App\Models\Specie;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $specie = '';
    public string $editSpecie = '';
    public ?int $editingId = null;

    #[Computed]
    public function species()
    {
        return Specie::all();
    }

    public function store()
    {
        $validated = $this->validate([
            'specie' => 'required|string|unique:species,name',
        ]);

        Specie::create(['name' => $validated['specie']]);
        $this->dispatch('specie-added');
        session()->flash('success', __('admin/global.specie_created'));

    }

    public function edit(Specie $specie)
    {
        $this->editSpecie = $specie->name;
        $this->editingId = $specie->id;
    }

    public function update()
    {
        $validated = $this->validate([
            'editSpecie' => 'required|string|unique:species,name',
        ]);

        $specie = Specie::findOrFail($this->editingId);
        $specie->update(['name' => $validated['editSpecie']]);

        $this->dispatch('specie-edited');
        session()->flash('success', __('admin/global.specie_edited'));

    }

    public function delete(Specie $specie)
    {
        $specie->delete();
        session()->flash('delete', __('admin/global.specie_deleted'));
    }
};
?>
<div>
    <section x-cloak x-data="{expanded: false, add: false, edit: false}" class="relative">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('delete'))
            <div class="alert-delete">
                {{ session('delete') }}
            </div>
        @endif
        <div class="w-fit mb-2 ml-auto cursor-pointer">
            <small class="underline" @click="add = true">{{__('admin/forms.add_element')}}</small>
        </div>
        <h3 type="button" x-on:click="expanded = !expanded"
            class="bg-primary cursor-pointer p-4 w-full rounded-xl flex items-center justify-between">
            {{__('admin/global.species')}}
            <svg class="w-5 h-5 transition-transform duration-300"
                 :class="{'rotate-180': expanded}"
                 fill="none"
                 stroke="black"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7"></path>
            </svg>
        </h3>

        <div x-show="expanded" class="border-primary border-1 rounded-xl border-t-0 p-4">
            <ul class="grid sx:grid-cols-2 gap-8">
                @foreach($this->species as $specie)
                    <li class="flex items-center gap-4" x-data="{edit: false, deleteModal: false}">
                        <p>{{$specie->name}}</p>
                        <div class="flex gap-2">
                            <img src="{{asset('assets/icons/edit.svg')}}"
                                 alt="{{__('global.edit_icon')}}"
                                 class="cursor-pointer"
                                 wire:click="edit({{$specie}})"
                                 @click="edit = true">
                            <img src="{{asset('assets/icons/delete.svg')}}"
                                 alt="{{__('global.delete_icon')}}"
                                 @click="deleteModal = true"
                                 class="cursor-pointer"
                            >

                            <livewire:admin.global.modal modalName="deleteModal">
                                <p class="my-4">
                                    {{__('admin/global.confirm_delete', ['category' => 'l\'espèce', 'name' => $specie->name])}}
                                </p>
                                <div class="flex flex-col md:flex-row flex-col md:flex-row gap-6 w-fit mt-5.5 ml-auto">
                                    <button @click="deleteModal = false"
                                       class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                                        {{__('admin/global.close')}}
                                    </button>
                                    <form wire:submit="delete({{$specie}})">
                                        <x-client.global.button
                                            title="{{__('admin/forms.delete_title')}}"
                                            :is-dangerous="true"
                                        >
                                            {{__('admin/forms.delete')}}
                                        </x-client.global.button>
                                    </form>
                                </div>
                            </livewire:admin.global.modal>
                        </div>
                        <div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="edit"></div>
                        <div x-show="edit" x-on:specie-edited.window="edit = false" @click.outside="edit = false"
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
                                <x-client.form.input
                                    wire:model.live="editSpecie"
                                    name="editSpecie"
                                    placeholder="{{$specie->name}}"
                                >
                                    {{__('admin/forms.specie_edit')}}
                                </x-client.form.input>
                                <div class="flex flex-col md:flex-row gap-6 w-fit mt-5.5 ml-auto">
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
        </div>

        <div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="add"></div>
        <div x-show="add" x-on:specie-added.window="add = false" @click.outside="add = false"
             @keydown.escape.window="add = false"
             class="p-6 fixed w-3/4 md:w-[50vw] z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
            <div class="absolute z-60 cursor-pointer top-2 right-2" @click="add = false">
                <svg viewBox="0 0 24 24" fill="black" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M16 8L8 16M8.00001 8L16 16" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </g>
                </svg>
            </div>
            <form wire:submit="store">
                <x-client.form.input
                    wire:model.live="specie"
                    name="specie"
                    placeholder="{{__('admin/global.dog')}}"
                >
                    {{__('admin/forms.add_specie')}}
                </x-client.form.input>
                <div class="flex flex-col md:flex-row gap-6 w-fit mt-5.5 ml-auto">
                    <button @click="add = false"
                       class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                        {{__('admin/global.close')}}
                    </button>
                    <x-client.global.button title="{{__('admin/forms.add_element')}}">
                        {{__('admin/forms.add')}}
                    </x-client.global.button>
                </div>
            </form>
        </div>
    </section>
</div>
