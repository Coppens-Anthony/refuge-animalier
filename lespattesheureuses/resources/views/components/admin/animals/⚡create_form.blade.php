<?php

use App\Enums\Sex;
use App\Enums\Status;
use App\Models\Animal;
use App\Models\AnimalVaccine;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use App\Models\Vaccine;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public $specie_id = null;
    public $breed_id = null;
    public $vaccine_id = null;
    public $coat_id = null;
    public string $name = '';
    public string $temperament = '';
    public App\Enums\Sex $sex;
    public DateTime $age;

    #[Computed]
    public function speciesOptions()
    {
        return Specie::all()->map(fn($specie) => [
            'value' => $specie->id,
            'trad' => $specie->name,
        ])->toArray();
    }

    #[Computed]
    public function breedsOptions()
    {
        return Breed::where('specie_id', $this->specie_id)
            ->get()
            ->map(fn($breed) => [
                'value' => $breed->id,
                'trad' => $breed->name,
            ])
            ->toArray();
    }

    #[Computed]
    public function vaccinesOptions()
    {
        return Vaccine::where('specie_id', $this->specie_id)
            ->get()
            ->map(fn($vaccine) => [
                'value' => $vaccine->id,
                'trad' => $vaccine->name,
            ])
            ->toArray();
    }

    #[Computed]
    public function coatsOptions()
    {
        return Coat::all()
            ->map(fn($coat) => [
                'value' => $coat->id,
                'trad' => $coat->name,
            ])
            ->toArray();
    }

    public function updatedSpecieId()
    {
        $this->breed_id = 0;
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => 'required',
            'breed_id' => 'required|exists:breeds,id',
            'age' => 'required|date|before:today',
            'sex' => ['required', Rule::enum(Sex::class)],
            'temperament' => 'required|max:255',
            'vaccine_id' => 'exists:vaccines,id',
            'specie_id' => 'exists:species,id',
            'coat_id' => 'exists:coats,id',
        ]);
        $validated['status'] = Status::ADOPTABLE;
        $validated['avatar'] = '';

        $animal = Animal::create($validated);

        $animal->vaccine()->attach($this->vaccine_id);
        $animal->coat()->attach($this->coat_id);

        return redirect(route('show.animals', $animal->id));
    }
};
?>

<div class="col-span-full">
    <form wire:submit="store" class="col-span-full flex flex-col gap-8">
        <div class="flex flex-col gap-2 w-fit mx-auto text-center mb-6 font-bold">
            <input id="avatar" name="avatar" type="file" class="invisible absolute top-0 left-0 h-0 w-0"
                   accept="image/*">
            <label for="avatar"
                   class="w-[175px] h-[175px] bg-gray-200 hover:bg-gray-300 duration-300 hover:duration-300 relative rounded-2xl cursor-pointer border-dashed border-1 border-black">
                <img src="{{asset('assets/icons/file_input_paw.svg')}}"
                     alt="{!! __('admin/forms.add_animal_image_alt') !!}"
                     class="absolute top-1/2 left-1/2 -translate-1/2 origin-center">
                <p class="absolute -bottom-12 w-full -translate-1/2 origin-center left-1/2">{!! __('admin/forms.add_image') !!}
                    <span class="text-secondary"> *</span></p>
            </label>
        </div>
        <div class="flex justify-between gap-4">
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.input
                    wire:model="name"
                    name="name"
                    placeholder="Max">
                    {!! __('admin/global.name') !!}
                </x-client.form.input>
                <x-client.form.select
                    name="specie"
                    wire:model.live="specie_id"
                    :options="$this->speciesOptions()">
                    {!! __('admin/global.specie') !!}
                </x-client.form.select>
                <x-client.form.select
                    name="breed"
                    wire:model.live="breed_id"
                    :options="$this->breedsOptions()">
                    {!! __('admin/global.breed') !!}
                </x-client.form.select>
                <x-client.form.input
                    wire:model="age"
                    name="age"
                    type="date"
                >
                    {!! __('admin/global.birthdate') !!}
                </x-client.form.input>
                <x-client.form.select
                    name="sex"
                    wire:model="sex"
                    :options="Sex::options()">
                    {!! __('admin/global.sex') !!}
                </x-client.form.select>
            </fieldset>
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.select
                    name="coat"
                    wire:model.live="coat_id"
                    :options="$this->coatsOptions()">
                    {!! __('admin/global.coat') !!}
                </x-client.form.select>
                <x-client.form.select
                    name="vaccine"
                    wire:model.live="vaccine_id"
                    :options="$this->vaccinesOptions()">
                    {!! __('admin/global.vaccines') !!}
                </x-client.form.select>
                <x-client.form.textarea
                    wire:model="temperament"
                    name="temperament"
                    placeholder="C'est un chien très affectueux qui adore la compagnie des humains. Il aime les balades et s'entend bien avec les autres chiens. Un peu méfiant au début, mais il devient vite un vrai pot de colle une fois en confiance."
                >
                    {!! __('admin/global.temperament') !!}
                </x-client.form.textarea>
            </fieldset>
        </div>
        <div class="mx-auto w-fit">
            <x-client.global.button
                title="{!! __('admin/forms.add_animal_title') !!}"
            >
                {!! __('admin/forms.add') !!}
            </x-client.global.button>
        </div>
    </form>
</div>
