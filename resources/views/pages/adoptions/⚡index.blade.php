<?php

use App\Enums\Adoptions;
use App\Models\Adoption;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Les adoptions')]
class extends Component {

};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.adoptions.adoptions_table/>
</div>
