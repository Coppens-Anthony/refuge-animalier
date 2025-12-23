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
    public Animal $animal;
    public string $status;

    public function mount()
    {
        $this->status = $this->animal->status->value;
    }

    public function update()
    {
        $validated = $this->validate([
            'status' => Rule::enum(Status::class)
        ]);

        $this->animal->update($validated);
    }
};
?>

<div>
    <section>
        <div class="flex flex-col md:flex-row md:gap-30 md:items-center mb-8">
            <div class="flex flex-col gap-8 md:w-1/2">
                <div class="flex items-center gap-6">
                    <h3 class="text-[2rem]">{{$this->animal->name}}</h3>
                    <div class="flex gap-2 items-center" x-data="{open: false}" x-cloak>
                        <x-client.global.status isInCard="{{false}}">
                            {{$this->animal->status->label()}}
                        </x-client.global.status>
                        <img src="{{asset('assets/icons/edit.svg')}}" alt="{{__('global.edit_icon')}}"
                             class="h-5.8 w-5.8 cursor-pointer"
                             @click="open = !open">
                        <livewire:admin.global.modal>
                            <form wire:submit="update" @submit="open = false">
                                <div class="flex flex-col gap-2">
                                    <label
                                        for="status">{{__('admin/global.change_status')}} {{$this->animal->name}}</label>
                                    <select name="status" id="status" wire:model="status"
                                            class="rounded-xl border-primary border-3 p-2 cursor-pointer">
                                        @foreach(Status::cases() as $status)
                                            <option value="{{$status}}"
                                                    @if($this->animal->status == $status) selected @endif>{{$status->label()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex gap-6 w-fit mt-5.5 ml-auto">
                                    <p @click="open = false"
                                       class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0    bg-white border-primary hover:bg-primary">
                                        {{__('admin/global.close')}}
                                    </p>
                                    <x-client.global.button
                                        title="{{__('admin/forms.edit_title')}}"
                                    >
                                        {{__('admin/forms.edit')}}
                                    </x-client.global.button>
                                </div>
                            </form>
                        </livewire:admin.global.modal>
                    </div>
                </div>
                <ul class="flex flex-col gap-4">
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->animal->breed->name}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->animal->age()}} {{__('global.yo')}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->animal->sex->label()}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{__('admin/global.coats')}} :
                            @foreach($this->animal->coat as $coat)
                                {{$coat->name}},
                            @endforeach
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{__('admin/global.vaccines')}} :
                            @foreach($this->animal->vaccine as $vaccine)
                                {{$vaccine->name}},
                            @endforeach
                        </x-client.global.icon_text>
                    </li>
                </ul>
                <article class="mb-8 md:mb-0">
                    <h4 class="text-2xl mb-2">{!! __('client/animals.character_title') !!}</h4>
                    <p>{{$this->animal->temperament}}</p>
                </article>
            </div>
            <div class="md:w-1/2 aspect-square">
                <img src="{{asset('avatars/originals/'.$this->animal->avatar)}}"
                     srcset="
                        {{asset('avatars/variants/300x300/'.$this->animal->avatar)}} 300w,
                        {{asset('avatars/variants/600x600/'.$this->animal->avatar)}} 600w,
                        {{asset('avatars/variants/900x900/'.$this->animal->avatar)}} 900w,
                        {{asset('avatars/variants/1200x1200/'.$this->animal->avatar)}} 1200w"
                     sizes="(max-width: 768px) 100vw, 50vw"
                     alt="{!! __('client/animals.animal_image_alt', ['name' => $this->animal->name]) !!}"
                     class="w-full h-full rounded-4xl object-cover">
            </div>
        </div>
    </section>
    <div class="w-fit mx-auto">
        <x-client.global.cta
            route="{{route('edit.animals', $this->animal->id)}}"
            title="{{__('global.edit_title')}}">
            {{__('admin/forms.edit')}}
        </x-client.global.cta>
    </div>
</div>
