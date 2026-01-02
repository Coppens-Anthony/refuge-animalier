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
            'lastname' => $this->member->lastname,
            'firstname' => $this->member->firstname,
            'email' => $this->member->email,
            'telephone' => $this->member->telephone,
            'status' => $this->member->status,
        ];
    }
};
?>

<div>
    <section class="flex flex-col md:flex-row gap-8 md:gap-30 md:items-center relative">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex flex-col gap-8 md:w-1/2">
            <div class="flex gap-4 items-center">
                <h3 class="text-2xl">{{$this->member->firstname . ' ' . $this->member->lastname}}</h3>
                <x-client.global.status
                    isInCard="{{false}}"
                >
                    {{$this->member->status->label()}}
                </x-client.global.status>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/email.svg')}}" alt="{!! __('global.email_icon') !!}">
                    <a href="mailto:{{$this->member->email}}"
                       {!! __('global.email_title') !!} class="link">{{$this->member->email}}</a>
                </div>
                <div class="flex gap-2 items-center">
                    <img src="{{asset('assets/icons/telephone.svg')}}" alt="{!! __('global.telephone_icon') !!}">
                    <a href="tel:{{$this->member->telephone}}"
                       {!! __('global.telephone_title') !!} class="link">{{$this->member->telephone}}</a>
                </div>
            </div>
        </div>
        <div class="md:w-1/2 aspect-square">
            @if(str_starts_with($this->member->avatar, 'public/assets/images/'))
                <img src="{{asset(str_replace('public/assets/', 'assets/', $this->member->avatar))}}"
                     alt="Photo de {{$this->member->firstname}}"
                     class="w-full h-full rounded-4xl object-cover">
            @else
                <img src="{{Storage::url('avatars/originals/'.$this->member->avatar)}}"
                     srcset="
                        {{Storage::url('avatars/variants/300x300/'.$this->member->avatar)}} 300w,
                        {{Storage::url('avatars/variants/600x600/'.$this->member->avatar)}} 600w,
                        {{Storage::url('avatars/variants/900x900/'.$this->member->avatar)}} 900w"
                     sizes="(max-width: 768px) 100vw, 50vw"
                     alt="{!! __('client/animals.animal_image_alt', ['name' => $this->member->firstname]) !!}"
                     class="w-full h-full rounded-4xl object-cover">
            @endif
        </div>
    </section>
</div>
