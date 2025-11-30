<?php

use Livewire\Component;

new class extends Component {
};
?>

<div>
    <table class="w-full text-center rounded-t-2xl overflow-hidden">
        <thead class="bg-primary">
        <tr class="table-row">
            <th></th>
            <th class="py-4">{{__('admin/dispo.monday')}}</th>
            <th>{{__('admin/dispo.tuesday')}}</th>
            <th>{{__('admin/dispo.wednesday')}}</th>
            <th>{{__('admin/dispo.thursday')}}</th>
            <th>{{__('admin/dispo.friday')}}</th>
            <th>{{__('admin/dispo.saturday')}}</th>
            <th>{{__('admin/dispo.sunday')}}</th>
        </tr>
        </thead>
        <tbody class="border-primary border-1">
        <tr class="border-b-primary border-b-1">
            <th class="py-2 border-r-1 border-primary">{{__('admin/dispo.morning')}}</th>
            @for($i = 1; $i <= 7; $i++)
                @php($random = rand(0, 1))
                <td class="w-1/8">
                    @if($random === 1)
                        <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="{{__('admin/dispo.check_alt')}}"
                             class="m-auto">
                    @else
                        <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="{{__('admin/dispo.cross_alt')}}"
                             class="m-auto">
                    @endif
                </td>
            @endfor
        </tr>
        <tr class="border-b-primary border-b-1">
            <th class="py-2 border-r-1 border-primary">{{__('admin/dispo.afternoon')}}</th>
            @for($i = 1; $i <= 7; $i++)
                @php($random = rand(0, 1))
                <td class="w-1/8">
                    @if($random === 1)
                        <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="{{__('admin/dispo.check_alt')}}"
                             class="m-auto">
                    @else
                        <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="{{__('admin/dispo.cross_alt')}}"
                             class="m-auto">
                    @endif
                </td>
            @endfor
        </tr>
        <tr class="border-b-primary border-b-1">
            <th class="py-2 border-r-1 border-primary">{{__('admin/dispo.evening')}}</th>
            @for($i = 1; $i <= 7; $i++)
                @php($random = rand(0, 1))
                <td class="w-1/8">
                    @if($random === 1)
                        <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="{{__('admin/dispo.check_alt')}}"
                             class="m-auto">
                    @else
                        <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="{{__('admin/dispo.cross_alt')}}"
                             class="m-auto">
                    @endif
                </td>
            @endfor
        </tr>
        </tbody>
    </table>
</div>
