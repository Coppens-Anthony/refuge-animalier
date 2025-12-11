<?php

use App\Models\User;
use Livewire\Component;

new class extends Component {
    public User $member;
    public array $member_datas;


    public function mount(User $member): void
    {
        $this->member_datas = [
            'avatar' => $this->member->avatar,
            'name' => $this->member->name,
            'email' => $this->member->email,
            'telephone' => $this->member->telephone,
            'status' => $this->member->status,
        ];
    }
};
?>

<div>
    <section class="flex gap-30 items-center">
        <div class="flex flex-col gap-8 w-1/2">
            <div class="flex gap-4 items-center">
                <h3 class="text-2xl">{{$this->member->name}}</h3>
                <x-client.global.status
                    isInCard="{{false}}"
                >
                    {{$this->member->status}}
                </x-client.global.status>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/email.svg')}}" alt="{!! __('global.email_icon') !!}">
                    <a href="mailto:{{$this->member->email}}" {!! __('global.email_title') !!} class="link">{{$this->member->email}}</a>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/telephone.svg')}}" alt="{!! __('global.telephone_icon') !!}">
                    <a href="tel:{{$this->member->telephone}}" {!! __('global.telephone_title') !!} class="link">{{$this->member->telephone}}</a>
                </div>
            </div>
        </div>
        <div class="w-1/2">
            <img src="{{asset('assets/images/johndoe.jpg')}}" alt="" class="rounded-4xl object-cover">
        </div>
    </section>
</div>
