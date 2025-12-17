<?php

use App\Enums\Members;
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
    public $breed_ids = [];
    public $vaccine_id = [];
    public $coat_id = [];
    public string $name = '';
    public string $temperament = '';
    public App\Enums\Sex $sex;
    public App\Enums\Status $status;
    public DateTime $age;


    #[Computed]
    public function speciesOptions(): array
    {
        return Specie::all()->map(fn($specie) => [
            'value' => $specie->id,
            'trad' => $specie->name,
        ])->toArray();
    }

    #[Computed]
    public function breedsOptions(): array
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
    public function vaccinesOptions(): array
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
    public function coatsOptions(): array
    {
        return Coat::all()
            ->map(fn($coat) => [
                'value' => $coat->id,
                'trad' => $coat->name,
            ])
            ->toArray();
    }



    public function updated($prop): void
    {
        if(str_contains($prop,'breed_ids')){
            unset($this->breedsOptions);
        }
        if(str_contains($prop,'coat_id')){
            unset($this->coatsOptions);
        }
        if(str_contains($prop,'vaccine_id')){
            unset($this->vaccinesOptions);
        }
        debug('oui');
        debug($prop);
    }

    public function store()
    {

        $validated = $this->validate([
            'name' => 'required',
            'breed_ids' => 'required|array',
            'breed_ids.*' => 'exists:breeds,id',
            'age' => 'required|date|before:today',
            'sex' => ['required', Rule::enum(Sex::class)],
            'temperament' => 'required|max:255',
            'status' => ['required', Rule::enum(Status::class)],
            'vaccine_id' => 'array',
            'vaccine_id.*' => 'exists:vaccines,id',
            'specie_id' => 'required|exists:species,id',
            'coat_id' => 'required|array',
            'coat_id.*' => 'exists:coats,id',
        ]);
        if (auth()->user()->status === Members::VOLUNTEER->value) {
            $validated['status'] = Status::PENDING;
        } else {
            $validated['status'];
        }
        $validated['avatar'] = '';
        dd($validated);

        $animal = Animal::create($validated);

        foreach ($vaccine_id as $vaccine) {
            $animal->vaccine()->attach($vaccine);
        }
        foreach ($coat_id as $coat) {
            $animal->coat()->attach($coat);
        }
        return redirect(route('show.animals', $animal->id));
    }
};
?>

<div class="col-span-full">
    <form wire:submit.prevent="store" class="col-span-full flex flex-col gap-8">
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
                    name="specie_id"
                    wire:model.live="specie_id"
                    :options="$this->speciesOptions">
                    {!! __('admin/global.specie') !!}
                </x-client.form.select>
                <livewire:admin.global.modal_checkbox
                    wire:model.live="breed_ids"
                    :key="'breeds-'.microtime()"
                    :fieldName="'breed'"
                    :options="$this->breedsOptions">
                    {!! __('admin/global.breed') !!}
                </livewire:admin.global.modal_checkbox>
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
            <fieldset class="w-1/2 flex flex-col gap-4" x-data="{open: false}">
                <livewire:admin.global.modal_checkbox
                    wire:model.live="coat_id"
                    :key="'coats-'.microtime()"
                    :fieldName="'coat'"
                    :options="$this->coatsOptions">
                    {!! __('admin/global.coat') !!}
                </livewire:admin.global.modal_checkbox>
                <livewire:admin.global.modal_checkbox
                    wire:model.live="vaccine_id"
                    :key="'vaccines-'.microtime()"
                    :fieldName="'vaccine'"
                    :options="$this->vaccinesOptions">
                    {!! __('admin/global.vaccines') !!}
                </livewire:admin.global.modal_checkbox>
                {{--@if(auth()->user()->status === Members::ADMINISTRATOR->value)
                    <x-client.form.select
                        name="status"
                        wire:model="status_id"
                        :options="Status::options()">
                        {!! __('admin/global.status') !!}
                    </x-client.form.select>
                @endif--}}
                <x-client.form.textarea
                    wire:model="temperament"
                    name="temperament"
                    placeholder="C'est un animal..."
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
