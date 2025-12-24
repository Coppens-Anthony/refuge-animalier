<?php

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Valider les nouvelles fiches')]
class extends Component {

    public function mount()
    {
        return $this->authorize('view-any', User::class);
    }
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.validations.validations_table/>
</div>
