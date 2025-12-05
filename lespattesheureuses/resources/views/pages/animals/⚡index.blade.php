<?php

use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tous les animaux')]
class extends Component {

    #[Computed]
    public function animals()
    {
        return Animal::with('breed')
            ->with('specie')->get();
    }
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.animals.animals_table
        :datas="$this->animals"
    />
</div>
