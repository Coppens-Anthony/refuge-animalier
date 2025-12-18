<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Valider les demandes d’adoptions')]
class extends Component {

    #[Computed]
    public function adoptions()
    {
        return $adoptions = Adoption::where('status', Adoptions::PENDING)->get();
    }
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.adoptions.adoptions_table
        :datas="$this->adoptions"
    />
</div>
