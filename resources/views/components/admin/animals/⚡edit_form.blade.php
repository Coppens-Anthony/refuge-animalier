<?php

use App\Enums\Members;
use App\Enums\Sex;
use App\Enums\Status;
use App\Jobs\ProcessUploadedAvatar;
use App\Models\Animal;
use App\Models\AnimalVaccine;
use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public $animalId;
    public $specie_id;
    public $breed_id;
    public $vaccine_ids = [];
    public $coat_ids = [];
    public $name = '';
    public $avatar;
    public $temperament = '';
    public $sex;
    public $status;
    public $birthdate;
    public $currentAvatar;

    public function mount()
    {

        $animal = Animal::with(['breed.specie', 'vaccine', 'coat'])->findOrFail($this->animalId);

        $this->name = $animal->name;
        $this->specie_id = $animal->breed->specie_id;
        $this->breed_id = $animal->breed_id;
        $this->birthdate = $animal->birthdate->format('Y-m-d');
        $this->sex = $animal->sex;
        $this->temperament = $animal->temperament;
        $this->status = $animal->status;
        $this->currentAvatar = $animal->avatar;

        $this->vaccine_ids = $animal->vaccine->pluck('id')->toArray();
        $this->coat_ids = $animal->coat->pluck('id')->toArray();
    }

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

    public function update()
    {
        $validated = $this->validate([
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'breed_id' => 'required|exists:breeds,id',
            'birthdate' => 'required|date|before:today',
            'sex' => ['required', Rule::enum(Sex::class)],
            'temperament' => 'required|string|max:255',
            'status' => ['nullable', Rule::enum(Status::class)],
            'vaccine_ids' => 'nullable|array',
            'vaccine_ids.*' => 'exists:vaccines,id',
            'coat_ids' => 'nullable|array',
            'coat_ids.*' => 'exists:coats,id',
        ]);

        $animal = Animal::findOrFail($this->animalId);

        if ($validated['status'] === Status::PENDING) {
            $validated['status'] = Status::ADOPTABLE;
        }

        if ($this->avatar) {
            $new_original_file_name = uniqid() . '.' . config('avatars.avatar_type');
            $full_path_to_original = Storage::disk('public')
                ->putFileAs(config('avatars.original_path'),
                    $this->avatar,
                    $new_original_file_name
                );
            if ($full_path_to_original) {
                $validated['avatar'] = $new_original_file_name;
                ProcessUploadedAvatar::dispatchSync($full_path_to_original, $new_original_file_name);
            }
        } else {
            unset($validated['avatar']);
        }

        unset($validated['vaccine_ids']);
        unset($validated['coat_ids']);

        $animal->update($validated);

        $animal->vaccine()->sync($this->vaccine_ids);
        $animal->coat()->sync($this->coat_ids);

        session()->flash('success', __('admin/global.animal_edited'));
        return redirect(route('show.animals', $animal->id));
    }
};
?>

<div class="col-span-full">
    <form wire:submit="update" class="col-span-full flex flex-col gap-8">
        @csrf
        <div class="flex flex-col gap-2 w-fit mx-auto text-center mb-12 font-bold">
            <input id="avatar" name="avatar" type="file" wire:model="avatar"
                   class="invisible absolute top-0 left-0 h-0 w-0"
                   accept="image/*">
            <label for="avatar"
                   class="w-[175px] h-[175px] bg-gray-200 hover:bg-gray-300 duration-300 hover:duration-300 relative rounded-2xl cursor-pointer border-dashed border-1 border-black">
                <img src="{{asset('assets/icons/file_input_paw.svg')}}"
                     alt="{!! __('admin/forms.add_animal_image_alt') !!}"
                     class="absolute top-1/2 left-1/2 -translate-1/2 origin-center">
                <p class="absolute -bottom-12 w-full -translate-1/2 origin-center left-1/2">{!! __('admin/forms.add_image') !!}
                    <span class="text-secondary"> *</span>
                    @error('avatar')
                    <small class="text-red-500 absolute -bottom-10 left-0">
                        {{ $message }}
                    </small>
                    @enderror</p>
                @if($this->avatar)
                    <img src="{{$this->avatar->temporaryUrl()}}" alt="{!! __('admin/table.image_alt') !!}"
                         class="object-cover absolute w-[175px] h-[175px] rounded-2xl top-0 left-0">
                @elseif($this->currentAvatar)
                    <img src="{{Storage::disk('s3')->url('avatars/originals/'.$this->currentAvatar)}}"
                         alt="{!! __('admin/table.image_alt') !!}"
                         class="object-cover absolute w-[175px] h-[175px] rounded-2xl top-0 left-0">
                @endif
            </label>
        </div>
        <div class="flex justify-between gap-4">
            <fieldset class="grid md:grid-cols-2 gap-4 w-full">
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
                <x-client.form.select
                    name="breed_id"
                    :isSpecieDependence="true"
                    wire:model.live="breed_id"
                    :options="$this->breedsOptions">
                    {!! __('admin/global.breed') !!}
                </x-client.form.select>
                <x-client.form.input
                    wire:model="birthdate"
                    name="birthdate"
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
                <livewire:admin.global.modal_checkbox
                    wire:model="coat_ids"
                    :key="'coats-'.microtime()"
                    :fieldName="'coat'"
                    :options="$this->coatsOptions">
                    {!! __('admin/global.coat') !!}
                </livewire:admin.global.modal_checkbox>
                <livewire:admin.global.modal_checkbox
                    wire:model="vaccine_ids"
                    :key="'vaccines-'.microtime()"
                    :fieldName="'vaccine'"
                    :options="$this->vaccinesOptions">
                    {!! __('admin/global.vaccines') !!}
                </livewire:admin.global.modal_checkbox>
                @can('view-any', User::class)
                    <x-client.form.select
                        name="status"
                        wire:model="status"
                        :options="Status::options()">
                        {!! __('admin/global.status') !!}
                    </x-client.form.select>
                @endcan
                <x-client.form.textarea
                    wire:model="temperament"
                    name="temperament"
                    rows="4"
                    placeholder="C'est un animal..."
                >
                    {!! __('admin/global.temperament') !!}
                </x-client.form.textarea>
            </fieldset>
        </div>
        <div class="mx-auto w-fit flex gap-4">
            <x-client.global.button
                title="{!! __('admin/forms.edit_title') !!}"
            >
                {!! __('admin/forms.edit') !!}
            </x-client.global.button>
        </div>
    </form>
</div>
