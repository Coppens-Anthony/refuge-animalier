<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Mon profil')]
class extends Component {
};
?>

<div class="flex flex-col gap-8">
    <livewire:admin.profile.hero/>
    <livewire:admin.profile.dispo/>
</div>
