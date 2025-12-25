<?php

use App\Models\Breed;
use App\Models\Specie;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $breed = '';
    public ?int $specieId = null;

    public string $editBreed = '';
    public ?int $editSpecieId = null;
    public ?int $editingId = null;

    #[Computed]
    public function breeds()
    {
        return Breed::with('specie')->get();
    }

    #[Computed]
    public function speciesOptions(): array
    {
        return Specie::all()->map(fn($specie) => [
            'value' => $specie->id,
            'trad' => $specie->name,
        ])->toArray();
    }

    public function store()
    {
        $validated = $this->validate([
            'breed' => 'required|string|unique:breeds,name',
            'specieId' => 'required|exists:species,id',
        ]);

        Breed::create([
            'name' => $validated['breed'],
            'specie_id' => $validated['specieId']
        ]);

        $this->reset(['breed', 'specieId']);
        $this->resetValidation();
        $this->dispatch('breed-added');
        session()->flash('success', __('admin/global.breed_created'));
    }

    public function edit(Breed $breed)
    {
        $this->editBreed = $breed->name;
        $this->editSpecieId = $breed->specie_id;
        $this->editingId = $breed->id;
    }

    public function update()
    {
        $validated = $this->validate([
            'editBreed' => 'string|unique:breeds,name,' . $this->editingId,
            'editSpecieId' => 'exists:species,id',
        ]);

        $breed = Breed::findOrFail($this->editingId);
        $breed->update([
            'name' => $validated['editBreed'],
            'specie_id' => $validated['editSpecieId']
        ]);

        $this->reset(['editBreed', 'editSpecieId', 'editingId']);
        $this->resetValidation();
        $this->dispatch('breed-edited');
        session()->flash('success', __('admin/global.breed_edited'));

    }

    public function delete($id)
    {
        $breed = Breed::findOrFail($id);
        $breed->delete();

        $this->dispatch('breed-deleted');
    }
};
?>
<div>
    <section x-cloak x-data="{expanded: false, add: false, edit: false}" class="relative">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="w-fit mb-2 ml-auto cursor-pointer">
            <small class="underline" @click="add = true">{{__('admin/forms.add_element')}}</small>
        </div>
        <h3 type="button" x-on:click="expanded = !expanded"
            class="bg-primary cursor-pointer p-4 w-full rounded-xl flex items-center justify-between">
            {{__('admin/global.breeds')}}
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
            <ul class="grid grid-cols-2 gap-8">
                @foreach($this->breeds as $breed)
                    <li class="flex items-center gap-4" x-data="{edit: false}">
                        <p>{{$breed->name}} - {{$breed->specie->name}}</p>
                        <div class="flex gap-2">
                            <img src="{{asset('assets/icons/edit.svg')}}"
                                 alt="{{__('global.edit_icon')}}"
                                 class="cursor-pointer"
                                 wire:click="edit({{$breed}})"
                                 @click="edit = true">
                            <form wire:submit="delete({{$breed->id}})">
                                <button type="submit" class="cursor-pointer">
                                    <img src="{{asset('assets/icons/delete.svg')}}"
                                         alt="{{__('global.delete_icon')}}">
                                </button>
                            </form>
                        </div>
                        <div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="edit"></div>
                        <div x-show="edit" x-on:breed-edited.window="edit = false" @click.outside="edit = false"
                             @keydown.escape.window="edit = false"
                             class="p-6 fixed w-[50vw] z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
                            <div class="absolute z-60 cursor-pointer top-2 right-2" @click="edit = false">
                                <svg viewBox="0 0 24 24" fill="black" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M16 8L8 16M8.00001 8L16 16" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                              stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                            </div>
                            <form wire:submit="update" class="flex flex-col gap-4">
                                <x-client.form.input
                                    wire:model="editBreed"
                                    name="editBreed"
                                    placeholder="{{$breed->name}}"
                                >
                                    {{__('admin/forms.breed_edit')}}
                                </x-client.form.input>
                                <x-client.form.select
                                    wire:model="editSpecieId"
                                    name="editSpecieId"
                                    :options="$this->speciesOptions"
                                >
                                    Associer à une espèce
                                </x-client.form.select>
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
        </div>

        <div class="inset-0 fixed z-40 bg-black opacity-50 w-full h-full" x-show="add"></div>
        <div x-show="add" x-on:breed-added.window="add = false" @click.outside="add = false"
             @keydown.escape.window="add = false"
             class="p-6 fixed w-[50vw] z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
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
            <form wire:submit="store" class="flex flex-col gap-4">
                <x-client.form.input
                    wire:model="breed"
                    name="breed"
                    placeholder="{{__('admin/global.dog')}}"
                >
                    {{__('admin/forms.add_breed')}}
                </x-client.form.input>
                <x-client.form.select
                    wire:model="specieId"
                    name="specieId"
                    :options="$this->speciesOptions"
                >
                    {{__('admin/forms.match_specie')}}
                </x-client.form.select>
                <div class="flex gap-6 w-fit mt-5.5 ml-auto">
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
