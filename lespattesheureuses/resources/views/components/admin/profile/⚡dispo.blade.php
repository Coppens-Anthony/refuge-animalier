<?php

use Livewire\Component;

new class extends Component {
    public string $dispo_title;
};
?>

<div>
    <section>
        <h3 class="mb-2 text-2xl">{{$dispo_title}}</h3>
        <livewire:admin.global.table.dispo_table/>
    </section>
</div>
