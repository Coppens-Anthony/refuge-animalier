<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <table class="w-full text-center rounded-t-2xl overflow-hidden">
        <thead class="bg-primary">
        <tr class="table-row">
            <th></th>
            <th class="py-4">Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
            <th>Samedi</th>
            <th>Dimanche</th>
        </tr>
        </thead>
        <tbody class="border-primary border-1">
        <tr class="border-b-primary border-b-1">
            <th class="py-2 border-r-1 border-primary">Matin</th>
            @for($i = 1; $i <= 7; $i++)
                @php($random = rand(0, 1))
                <td class="w-1/8">
                    @if($random === 1)
                        <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="" class="m-auto">
                    @else
                        <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="" class="m-auto">
                    @endif
                </td>
            @endfor
        </tr>
        <tr class="border-b-primary border-b-1">
            <th class="py-2 border-r-1 border-primary">Après-midi</th>
            @for($i = 1; $i <= 7; $i++)
                @php($random = rand(0, 1))
                <td class="w-1/8">
                    @if($random === 1)
                        <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="" class="m-auto">
                    @else
                        <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="" class="m-auto">
                    @endif
                </td>
            @endfor
        </tr>
        <tr class="border-b-primary border-b-1">
            <th class="py-2 border-r-1 border-primary">Soir</th>
            @for($i = 1; $i <= 7; $i++)
                @php($random = rand(0, 1))
                <td class="w-1/8">
                    @if($random === 1)
                        <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="" class="m-auto">
                    @else
                        <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="" class="m-auto">
                    @endif
                </td>
            @endfor
        </tr>
        </tbody>
    </table>
</div>
