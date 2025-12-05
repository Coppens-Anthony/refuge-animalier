<?php

use App\Models\Animal;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Fiche de ')]
class extends Component {
    public Animal $animal;
    public array $animal_datas;

    public function mount(Animal $animal): void
    {
        $this->animal_datas = [
            'avatar' => $this->animal->avatar,
            'name' => $this->animal->name,
            'age' => $this->animal->age,
            'breed' => $this->animal->breed,
            'sex' => $this->animal->sex,
            'coat' => $this->animal->coat,
            'temperament' => $this->animal->temperament,
            'status' => $this->animal->status,
        ];
    }
};
?>

<div>
    <p>{{$this->animal->avatar,}} </p>
    <p>{{$this->animal->name,}} </p>
    <p>{{$this->animal->age,}} </p>
    <p>{{$this->animal->breed->name}} </p>
    <p>{{$this->animal->specie->name}} </p>
    <p>{{$this->animal->sex,}} </p>
    <p>{{$this->animal->coat,}} </p>
    <p>{{$this->animal->temperament,}} </p>
    <p>{{$this->animal->status,}} </p>
</div>
