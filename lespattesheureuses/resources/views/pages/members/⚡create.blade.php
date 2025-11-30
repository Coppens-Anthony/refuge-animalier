<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ajouter un membre')]
class extends Component {
    //
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.members.create_form/>
</div>
