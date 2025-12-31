<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $member;
};
?>

<div>
    <div class="flex flex-col gap-4 md:hidden">
        @foreach($member->availabilities as $day => $periods)
            <div class="border border-primary rounded-2xl p-4">
                <h3 class="font-semibold text-lg mb-3">{{__("admin/dispo.$day")}}</h3>
                <div class="flex flex-col gap-2">
                    @foreach(['morning', 'afternoon', 'evening'] as $period)
                        <div class="flex justify-between items-center py-2 border-b border-primary last:border-0">
                            <span class="opacity-60">{{ __("admin/dispo.$period") }}</span>
                            @if($periods[$period])
                                <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="{{__('admin/dispo.check_alt')}}" class="w-6 h-6">
                            @else
                                <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="{{__('admin/dispo.cross_alt')}}" class="w-6 h-6">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <table class="hidden md:table w-full text-center rounded-t-2xl overflow-hidden">
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
                            <img src="{{asset('assets/icons/dispo_yes.svg')}}" alt="{{__('admin/dispo.check_alt')}}" class="m-auto">
                        @else
                            <img src="{{asset('assets/icons/dispo_no.svg')}}" alt="{{__('admin/dispo.cross_alt')}}" class="m-auto">
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
