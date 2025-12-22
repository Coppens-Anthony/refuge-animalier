<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Valider les nouvelles fiches')]
class extends Component {
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.validations.validations_table/>
</div>
