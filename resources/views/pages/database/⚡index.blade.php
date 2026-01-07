<?php

use App\Models\Breed;
use App\Models\Coat;
use App\Models\Specie;
use App\Models\User;
use App\Models\Vaccine;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Base de données')]
class extends Component {

    #[Computed]
    public function mount()
    {
        $this->authorize('view-any', User::class);
    }

    #[Computed]
    public function speciesOptions(): array
    {
        return Specie::all()->map(fn($specie) => [
            'value' => $specie->id,
            'trad' => $specie->name,
        ])->toArray();
    }
};
?>
<div class="flex flex-col gap-8">
    <livewire:admin.database.species/>
    <livewire:admin.database.breeds :speciesOptions="$this->speciesOptions"/>
    <livewire:admin.database.vaccines :speciesOptions="$this->speciesOptions"/>
    <livewire:admin.database.coats/>
</div>
