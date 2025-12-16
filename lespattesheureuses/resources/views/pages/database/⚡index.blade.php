<?php

use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use App\Models\Vaccine;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Base de données')]
class extends Component {
    public $species = [];
    public $breeds = [];
    public $vaccines = [];
    public $coats = [];

    #[Computed]
    public function mount()
    {
        $this->species = Specie::all();
        $this->breeds = Breed::with('specie')->get();
        $this->vaccines = Vaccine::all();
        $this->coats = Coat::all();
    }
};
?>
<div class="flex flex-col gap-8">
    <section x-data="{expanded: false}">
        <div class="w-fit mb-2 ml-auto cursor-pointer">
            <small class="underline">Ajouter un élément</small>
        </div>
        <h3 type="button" x-on:click="expanded = ! expanded"
            class="bg-primary cursor-pointer p-4 w-full rounded-xl flex items-center justify-between">
            {{__('admin/global.species')}}
            <svg
                class="w-5 h-5 transition-transform duration-300"
                :class="{'rotate-180': expanded}"
                fill="none"
                stroke="black"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </h3>
        <div x-show="expanded" class="border-primary border-1 rounded-xl border-t-0 p-4">
            <ul class="grid grid-cols-2 gap-8">
                @foreach($this->species as $specie)
                    <li class="flex items-center gap-4">
                        <p>
                            {{$specie->name}}
                        </p>
                        <div class="flex gap-2">
                            <img src="{{asset('assets/icons/edit.svg')}}" alt="{{__('global.edit_icon')}}">
                            <img src="{{asset('assets/icons/delete.svg')}}" alt="{{__('global.delete_icon')}}">
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section x-data="{expanded: false}">
        <div class="w-fit mb-2 ml-auto cursor-pointer">
            <small class="underline">Ajouter un élément</small>
        </div>
        <h3 type="button" x-on:click="expanded = ! expanded"
            class="bg-primary cursor-pointer p-4 w-full rounded-xl flex items-center justify-between">
            {{__('admin/global.breeds')}}
            <svg
                class="w-5 h-5 transition-transform duration-300"
                :class="{'rotate-180': expanded}"
                fill="none"
                stroke="black"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </h3>
        <div x-show="expanded" class="border-primary border-1 rounded-xl border-t-0 p-4">
            <ul class="grid grid-cols-2 gap-8">
                @foreach($this->breeds as $breed)
                    <li class="flex items-center gap-4">
                        <p>
                            {{$breed->name}} - {{$breed->specie->name}}
                        </p>
                        <div class="flex gap-2">
                            <img src="{{asset('assets/icons/edit.svg')}}" alt="{{__('global.edit_icon')}}">
                            <img src="{{asset('assets/icons/delete.svg')}}" alt="{{__('global.delete_icon')}}">
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section x-data="{expanded: false}">
        <div class="w-fit mb-2 ml-auto cursor-pointer">
            <small class="underline">Ajouter un élément</small>
        </div>
        <h3 type="button" x-on:click="expanded = ! expanded"
            class="bg-primary cursor-pointer p-4 w-full rounded-xl flex items-center justify-between">
            {{__('admin/global.vaccines')}}
            <svg
                class="w-5 h-5 transition-transform duration-300"
                :class="{'rotate-180': expanded}"
                fill="none"
                stroke="black"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </h3>
        <div x-show="expanded" class="border-primary border-1 rounded-xl border-t-0 p-4">
            <ul class="grid grid-cols-2 gap-8">
                @foreach($this->vaccines as $vaccine)
                    <li class="flex items-center gap-4">
                        <p>
                            {{$vaccine->name}} - {{$vaccine->specie->name}}
                        </p>
                        <div class="flex gap-2">
                            <img src="{{asset('assets/icons/edit.svg')}}" alt="{{__('global.edit_icon')}}">
                            <img src="{{asset('assets/icons/delete.svg')}}" alt="{{__('global.delete_icon')}}">
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <livewire:admin.database.coats/>
</div>
