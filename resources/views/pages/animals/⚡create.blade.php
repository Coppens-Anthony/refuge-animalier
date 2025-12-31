<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ajouter un animal')]
class extends Component {
    //
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.animals.create_form/>
</div>
