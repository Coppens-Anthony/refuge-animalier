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
    <livewire:admin.database.species/>
    <livewire:admin.database.breeds/>
    <livewire:admin.database.vaccines/>
    <livewire:admin.database.coats/>
</div>
