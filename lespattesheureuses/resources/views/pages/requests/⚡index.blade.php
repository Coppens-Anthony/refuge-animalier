<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Valider les demandes d’adoptions')]
class extends Component {
    //
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.requests.requests_table/>
</div>
