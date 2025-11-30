<?php

use Livewire\Component;

new class extends Component {
    public array $titles;
    public array $datas;
};
?>

<div>
    <table class="w-full text-center rounded-t-2xl overflow-hidden">
        <thead class="bg-primary">
        <tr class="table-row">
            @foreach($titles as $title)
                <th class="py-4">
                    {{$title}}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody class="border-primary border-1">
        @foreach($datas as $data)
            <tr class="border-b-primary border-b-1 hover:bg-primary-opacity cursor-pointer">
                @foreach($data as $key => $value)
                    <td class="py-2 w-1/{{count($titles)}}">
                        @if (is_string($value) && preg_match('/\.(jpg|jpeg|png|webp|svg)$/i', $value))
                            <img src="{{ asset($value) }}" alt="{!! __('admin/table.image_alt') !!}" class="w-12 h-12 rounded-full object-cover mx-auto">
                        @else
                            <span>
                                {{ $value }}
                            </span>
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
