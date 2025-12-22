<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $member;
};
?>

<div>
    <table class="w-full text-center rounded-t-2xl overflow-hidden">
        <thead class="bg-primary">
        <tr class="table-row">
            <th></th>
            @foreach(array_keys($member->availabilities) as $day)
                <th class="py-4">{{__("admin/dispo.$day")}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody class="border-primary border-1">
        @foreach(['morning', 'afternoon', 'evening'] as $period)
            <tr class="border-b-primary border-b-1">
                <th class="py-2 border-r-1 border-primary">{{ __("admin/dispo.$period") }}</th>
                @foreach($member->availabilities as $day => $periods)
                    <td class="w-1/8">
                        @if($periods[$period])
                            <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="{{__('admin/dispo.check_alt')}}"
                                 class="m-auto">
                        @else
                            <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="{{__('admin/dispo.cross_alt')}}"
                                 class="m-auto">
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

