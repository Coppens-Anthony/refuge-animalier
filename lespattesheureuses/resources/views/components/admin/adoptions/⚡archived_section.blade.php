<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adoption;
use Carbon\Carbon;
use Livewire\Component;

new class extends Component {
    public Adoption $adoption;
};
?>

<div>
    <section>
        <div class="flex flex-col gap-8">
            <h3 class="text-[2rem]">{{$this->adoption->adopter->name}}</h3>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/email.svg')}}" alt="{!! __('global.email_icon') !!}">
                    <a href="mailto:{{$this->adoption->adopter->email}}"
                       {!! __('global.email_title') !!} class="link">{{$this->adoption->adopter->email}}</a>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/telephone.svg')}}" alt="{!! __('global.telephone_icon') !!}">
                    <a href="tel:{{$this->adoption->adopter->telephone}}"
                       {!! __('global.telephone_title') !!} class="link">{{$this->adoption->adopter->telephone}}</a>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/calendar.svg')}}" alt="{!! __('global.calendar_icon') !!}">
                    <p>{{__('admin/global.adopted_at')}} {{$this->adoption->formatDate('date')}}</p>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/back_arrow.svg')}}" alt="{!! __('global.back_arrow_icon') !!}">
                    <p>{{__('admin/global.returned_at')}} {{$this->adoption->formatDate('updated_at')}}</p>
                </div>
            </div>
        </div>
    </section>
</div>
