<?php

use App\Enums\Status;
use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Valider les nouvelles fiches')]
class extends Component {

    #[Computed]
    public function animals()
    {
        return $animals = Animal::where('status', Status::PENDING)
            ->paginate(10)
            ->through(fn($data) => [
                'id' => $data->id,
                'cols' => [
                    $data->avatar,
                    $data->name,
                    $data->breed->specie->name,
                    $data->breed->name,
                    $data->sex,
                    $data->birthdate->age . ' ans',
                ]
            ]);
    }
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.validations.validations_table
        :datas="$this->animals->items()"
    />
</div>
