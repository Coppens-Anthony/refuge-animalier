<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Tous les membres')]
class extends Component {
    //
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.members.members_table/>
</div>
