<?php

use App\Models\Coat;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $coat = '';
    public string $editCoat = '';
    public ?int $editingId = null;

    #[Computed]
    public function coats()
    {
        return Coat::all();
    }

    public function store()
    {
        $validated = $this->validate([
            'coat' => 'required|string|unique:coats,name',
        ]);

        Coat::create(['name' => $validated['coat']]);
        $this->dispatch('coat-added');
        session()->flash('success', __('admin/global.coat_created'));
    }

    public function edit(Coat $coat)
    {
        $this->editCoat = $coat->name;
        $this->editingId = $coat->id;
    }

    public function update()
    {
        $validated = $this->validate([
            'editCoat' => 'required|string|unique:coats,name',
        ]);

        $coat = Coat::findOrFail($this->editingId);
        $coat->update(['name' => $validated['editCoat']]);

        $this->dispatch('coat-edited');
        session()->flash('success', __('admin/global.coat_edited'));
    }

    public function delete(Coat $coat)
    {
        $coat->delete();
        session()->flash('delete', __('admin/global.coat_deleted'));
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
            {{__('admin/global.coats')}}
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
                @foreach($this->coats as $coat)
                    <li class="flex items-center gap-4" x-data="{edit: false, deleteModal: false}">
                        <p>{{$coat->name}}</p>
                        <div class="flex gap-2">
                            <img src="{{asset('assets/icons/edit.svg')}}"
                                 alt="{{__('global.edit_icon')}}"
                                 class="cursor-pointer"
                                 wire:click="edit({{$coat}})"
                                 @click="edit = true">
                            <img src="{{asset('assets/icons/delete.svg')}}"
                                 alt="{{__('global.delete_icon')}}"
                                 @click="deleteModal = true"
                                 class="cursor-pointer"
                            >

                            <livewire:admin.global.modal modalName="deleteModal">
                                <p class="mb-4">
                                    {{__('admin/global.confirm_delete', ['category' => 'le pelage', 'name' => $coat->name])}}
                                </p>
                                <div class="flex flex-col md:flex-row gap-6 w-fit mt-5.5 ml-auto">
                                    <button @click="deleteModal = false"
                                       class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                                        {{__('admin/global.close')}}
                                    </button>
                                    <form wire:submit="delete({{$coat}})">
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
                        <div x-show="edit" x-on:coat-edited.window="edit = false" @click.outside="edit = false"
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
                                    wire:model.live="editCoat"
                                    name="editCoat"
                                    placeholder="{{$coat->name}}"
                                >
                                    {{__('admin/forms.coat_edit')}}
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
        <div x-show="add" x-on:coat-added.window="add = false" @click.outside="add = false"
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
                    wire:model.live="coat"
                    name="coat"
                    placeholder="{{__('admin/forms.fire')}}"
                >
                    {{__('admin/forms.add_coat')}}
                </x-client.form.input>
                <div class="flex flex-col md:flex-row gap-6 w-fit mt-5.5 ml-auto">
                    <p @click="add = false"
                       class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                        {{__('admin/global.close')}}
                    </p>
                    <x-client.global.button title="{{__('admin/forms.add_element')}}">
                        {{__('admin/forms.add')}}
                    </x-client.global.button>
                </div>
            </form>
        </div>
    </section>
</div>
