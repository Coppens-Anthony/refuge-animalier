<?php

use Livewire\Component;

new class extends Component {
    public array $titles;
};
?>

<div>
    <table class="w-full md:text-center md:rounded-t-2xl md:overflow-hidden md:table-fixed">
        <thead class="hidden md:table-header-group bg-primary">
        <tr class="table-row">
            @foreach($titles as $title)
                <th class="py-4">
                    {{$title}}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody class="flex flex-col gap-4 md:table-row-group md:border-primary md:border-1">
        {{$slot}}
        </tbody>
    </table>
</div>
