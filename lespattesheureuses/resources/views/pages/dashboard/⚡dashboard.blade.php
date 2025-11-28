<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Dashboard')]
class extends Component {
};
?>

<div class="grid grid-cols-10 gap-4">
    <livewire:admin.dashboard.key_section/>
</div>
