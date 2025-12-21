<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Adopter;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public $datas;
    public $animals;
    public $adopters;
    public $animalId;
    public $adopterId;
    public $message;

    public function mount()
    {
        $this->animals = Animal::all();
        $this->adopters = Adopter::all();
    }

    #[Computed]
    public function animalsOptions(): array
    {
        return $this->animals->map(fn($animal) => [
            'value' => $animal->id,
            'trad' => $animal->name,
        ])->toArray();
    }
    #[Computed]
    public function adoptersOptions(): array
    {
        return $this->adopters->map(fn($adopter) => [
            'value' => $adopter->id,
            'trad' => $adopter->name,
        ])->toArray();
    }

    public function store()
    {
        $validated = $this->validate([
        'animalId' => 'required|exists:animals,id',
        'adopterId' => 'required|exists:adopters,id',
        'message' => 'required'
        ]);

        $adoption = Adoption::create([
        'animal_id' => $validated['animalId'],
        'adopter_id' => $validated['adopterId'],
        'message' => $validated['message'],
        'status' => Adoptions::IN_PROGRESS,
        ]);
        return redirect(route('show.adoptions', $adoption->id));
    }

};
?>

<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <div class="flex justify-end mt-4" x-data="{ open: false}" x-cloak>
            <h3 class="sr-only">{!!__('admin/nav.adoptions') !!}</h3>
            <div>
                <button
                    @click="open = true"
                    title="{{__('admin/global.add_adoption')}}"
                    class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 cursor-pointer bg-primary border-primary hover:bg-white">
                    {{__('admin/global.create_adoption')}}
                </button>
            </div>
            <livewire:admin.global.modal>
                <form wire:submit="store" class="flex flex-col gap-4">
                    <x-client.form.select
                        name="animal"
                        wire:model="animalId"
                        :options="$this->animalsOptions"
                    >
                        {{__('admin/global.animal_name')}}
                    </x-client.form.select>
                    <x-client.form.select
                        name="adopter"
                        wire:model="adopterId"
                        :options="$this->adoptersOptions"
                    >
                        {{__('admin/global.adopter_name')}}
                    </x-client.form.select>
                    <x-client.form.textarea
                        name="message"
                        wire:model="message"
                        placeholder="{{__('admin/global.message_placeholder')}}"
                        rows="4"
                    >
                        {{__('global.message')}}
                    </x-client.form.textarea>
                    <div class="flex gap-6 w-fit mt-5.5 ml-auto">
                        <p @click="edit = false"
                           class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                            {{__('admin/global.close')}}
                        </p>
                        <x-client.global.button
                            title="{{__('admin/forms.add_title')}}">
                            {{__('admin/forms.add')}}
                        </x-client.global.button>
                    </div>
                </form>
            </livewire:admin.global.modal>
        </div>


        <livewire:admin.global.table.table
            :titles="[__('admin/global.animal_name'), __('admin/global.adopter_name'), __('admin/global.date'), __('admin/global.status')]"
            :rows="$this->datas"
            :route="'show.adoptions'"
        />
    </section>
</div>
