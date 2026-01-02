<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adoption;
use App\Models\AdoptionNote;
use App\Models\Animal;
use App\Models\Note;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Adoption de l’animal')]
class extends Component {
    public Adoption $adoption;
};
?>

<div>
    <section class="relative">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('delete'))
            <div class="alert-delete">
                {{ session('delete') }}
            </div>
        @endif
        <div class="flex flex-col md:flex-row md:gap-30 md:items-center mb-8">
            <div class="flex flex-col gap-8 md:w-1/2">
                <div class="flex items-center gap-6">
                    <h3 class="text-[2rem]">{{$this->adoption->animal->name}}</h3>
                    <div class="flex gap-2 items-center" x-data="{open: false}" x-cloak>
                        <x-client.global.status isInCard="{{false}}">
                            {{$this->adoption->animal->status->label()}}
                        </x-client.global.status>
                    </div>
                </div>
                <ul class="flex flex-col gap-4">
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->adoption->animal->breed->name}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->adoption->animal->age()}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->adoption->animal->sex->label()}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{__('admin/global.coats')}} :
                            @foreach($this->adoption->animal->coat as $coat)
                                {{$coat->name}},
                            @endforeach
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{__('admin/global.vaccines')}} :
                            @foreach($this->adoption->animal->vaccine as $vaccine)
                                {{$vaccine->name}},
                            @endforeach
                        </x-client.global.icon_text>
                    </li>
                </ul>
                <article class="mb-8 md:mb-0">
                    <h4 class="text-2xl mb-2">{!! __('client/animals.character_title') !!}</h4>
                    <p>{{$this->adoption->animal->temperament}}</p>
                </article>
            </div>
            <div class="md:w-1/2 aspect-square" wire:key="animal-image-{{$this->adoption->animal->id}}">
                @if(str_starts_with($this->adoption->animal->avatar, 'public/assets/images/animals/'))
                    <img src="{{asset(str_replace('public/assets/', 'assets/', $this->adoption->animal->avatar))}}"
                         alt="Photo de {{$this->adoption->animal->name}}"
                         class="w-full h-full rounded-4xl object-cover">
                @else
                    <img src="{{Storage::url('avatars/originals/'.$this->adoption->animal->avatar)}}"
                         srcset="
                        {{Storage::url('avatars/variants/300x300/'.$this->adoption->animal->avatar)}} 300w,
                        {{Storage::url('avatars/variants/600x600/'.$this->adoption->animal->avatar)}} 600w,
                        {{Storage::url('avatars/variants/900x900/'.$this->adoption->animal->avatar)}} 900w"
                         sizes="(max-width: 768px) 100vw, 50vw"
                         alt="{!! __('client/animals.animal_image_alt', ['name' => $this->adoption->animal->name]) !!}"
                         class="w-full h-full rounded-4xl object-cover">
                @endif
            </div>
        </div>
    </section>
    <section class="flex flex-col md:flex-row gap-8 md:gap-30">
        <div class="flex flex-col gap-8 md:w-1/2">
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
                @if($this->adoption->status === Adoptions::FINISHED || $this->adoption->status === Adoptions::ARCHIVED)
                    <div class="flex gap-2 items-center">
                        <img src="{{asset('assets/icons/calendar.svg')}}" alt="{!! __('global.calendar_icon') !!}">
                        <p>{{__('admin/global.adopted_at')}} {{$this->adoption->formatDate('date')}}</p>
                    </div>
                @endif
                @if($this->adoption->status === Adoptions::ARCHIVED)
                    <div class="flex gap-2 items-center">
                        <img src="{{asset('assets/icons/back_arrow.svg')}}" alt="{!! __('global.back_arrow_icon') !!}">
                        <p>{{__('admin/global.returned_at')}} {{$this->adoption->formatDate('updated_at')}}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="md:w-1/2">
            <p class="text-2xl mb-2">Son message</p>
            <p>{{$this->adoption->message}}</p>
        </div>
    </section>
    @if($this->adoption->status != Adoptions::PENDING)
        <livewire:admin.adoptions.notes_section :adoption="$this->adoption"/>
    @endif

    @if($this->adoption->status === Adoptions::PENDING)
        <livewire:admin.adoptions.pending_section :adoption="$this->adoption"/>
    @elseif($this->adoption->status === Adoptions::IN_PROGRESS)
        <livewire:admin.adoptions.in_progress_section :adoption="$this->adoption"/>
    @elseif($this->adoption->status === Adoptions::FINISHED)
        <livewire:admin.adoptions.finished_section :adoption="$this->adoption"/>
    @endif
</div>
