<?php

use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Dashboard')]
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
    <livewire:admin.dashboard.key_section/>
    <livewire:admin.dashboard.animals_table
        :datas="$this->animals"
    />
    <livewire:admin.dashboard.statistiques/>
</div>
