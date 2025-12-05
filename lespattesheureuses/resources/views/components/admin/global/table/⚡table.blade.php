<?php

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

new class extends Component {
    public array $titles;
    public $rows;
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
        @foreach($rows as $row)
            <tr class="hover:bg-primary-opacity cursor-pointer">
                @foreach($row as $cell)
                    <td class="py-2">
                        @if (is_string($cell) && preg_match('/\.(jpg|jpeg|png|webp|svg)$/i', $cell))
                            <img src="{{ asset($cell) }}" class="w-12 h-12 rounded-full object-cover mx-auto" alt="">
                        @else
                            {{ $cell }}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
