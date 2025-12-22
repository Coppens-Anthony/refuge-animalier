<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

new class extends Component {
    public array $titles;
};
?>

<div>
    <table class="w-full text-center rounded-t-2xl overflow-hidden">
        <thead class="bg-primary">
        <tr class="table-row">
            @foreach($titles as $title)
                <th class="py-4 w-1/{{count($titles)}}">
                    {{$title}}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody class="border-primary border-1">
        {{$slot}}
        </tbody>
    </table>
</div>
