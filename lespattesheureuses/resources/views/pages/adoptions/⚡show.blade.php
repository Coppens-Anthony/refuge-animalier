<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Fiche de ')]
class extends Component {
    public Adoption $adoption;
};
?>

<div>
    <section>
        <div class="flex flex-col md:flex-row md:gap-30 md:items-center mb-8">
            <div class="flex flex-col gap-8 md:w-1/2">
                <div class="flex items-center gap-6">
                    <h3 class="text-[2rem]">{{$this->adoption->animal->name}}</h3>
                    <div class="flex gap-2 items-center" x-data="{open: false}" x-cloak>
                        <x-client.global.status isInCard="{{false}}">
                            {{$this->adoption->animal->status}}
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
                            {{$this->adoption->animal->age()}} {{__('global.yo')}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->adoption->animal->sex}}
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
            <div class="md:w-1/2 relative">
                <img src="{{asset('assets/images/max.jpg')}}"
                     alt="{!! __('client/animals.animal_image_alt', ['name' => $this->adoption->animal->name]) !!}"
                     class="w-full h-full rounded-4xl">
            </div>
        </div>
    </section>
    @if($this->adoption->status === Adoptions::PENDING->value)
        <livewire:admin.adoptions.pending_section :adoption="$this->adoption"/>
    @elseif($this->adoption->status === Adoptions::IN_PROGRESS->value)
        <livewire:admin.adoptions.in_progress_section :adoption="$this->adoption"/>
    @elseif($this->adoption->status === Adoptions::FINISHED->value)
        <livewire:admin.adoptions.finished_section :adoption="$this->adoption"/>
    @endif
</div>
