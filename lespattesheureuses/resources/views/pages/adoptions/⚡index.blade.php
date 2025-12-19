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
        return $adoptions = Adoption::paginate(10)
            ->through(fn($data) => [
            'id' => $data->id,
            'cols' => [
                $data->animal->name,
                $data->adopter->name,
                $data->adopter->created_at,
                $data->status,
            ]
        ]);
    }
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.adoptions.adoptions_table
        :datas="$this->adoptions->items()"
    />
</div>
