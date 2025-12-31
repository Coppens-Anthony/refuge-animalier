<?php

use App\Models\Animal;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Modifier l’animal')]
class extends Component {
    public Animal $animal;

    public function mount()
    {
        $this->authorize('view-any', auth()->user());
    }
};
?>

<div>
    <div class="grid grid-cols-10 gap-4">
        <livewire:admin.animals.edit_form :animalId="$this->animal->id"/>
    </div>
</div>
