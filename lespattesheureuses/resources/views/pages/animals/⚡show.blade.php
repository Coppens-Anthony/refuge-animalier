<?php

use App\Enums\Status;
use App\Models\Animal;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Fiche de ')]
class extends Component {
    public Animal $animal;
    public array $animal_datas;

    public function mount(Animal $animal): void
    {
        $this->animal_datas = [
            'avatar' => $this->animal->avatar,
            'name' => $this->animal->name,
            'age' => $this->animal->age,
            'breed' => $this->animal->breed,
            'sex' => $this->animal->sex,
            'coat' => $this->animal->coat,
            'temperament' => $this->animal->temperament,
            'status' => $this->animal->status,
        ];
    }

    public $showModal = false;
};
?>

<?php
$args = [
    $this->animal->age,
    $this->animal->sex,
    $this->animal->coat,
]
?>

<div>
    <section class="mb-32">
        <div class="flex flex-col md:flex-row md:gap-30 md:items-center mb-8">
            <div class="flex flex-col gap-8 md:w-1/2">
                <div class="flex items-center gap-6">
                    <h3 class="text-[2rem]">{{$this->animal->name}}</h3>
                    <div class="flex gap-2 items-center" x-data="{open: false}">
                        <x-client.global.status isInCard="{{false}}">
                            {{$this->animal->status}}
                        </x-client.global.status>
                        <img src="{{asset('assets/icons/edit.svg')}}" alt="" class="h-5.8 w-5.8 cursor-pointer"
                             @click="open = !open">
                        <div x-show="open">
                            <div class="p-6 w-[80%] md:w-1/2 lg:w-1/3 fixed z-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl backdrop:bg-black backdrop:opacity-50">
                                <form action="">
                                    <div class="flex flex-col gap-2">
                                        <label for="status">Changer le statut de {{$this->animal->name}}</label>
                                        <select name="status" id="status" class="rounded-xl border-primary border-3 p-2 cursor-pointer">
                                            @foreach(Status::values() as $status)
                                                <option value="{{$this->animal->$status}}" @if($this->animal->status == $status) selected @endif>{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ml-auto mt-4 w-fit">
                                        <x-client.global.button
                                            title=""
                                        >
                                            Modifier
                                        </x-client.global.button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                            {{$this->animal->age}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->animal->sex}}
                        </x-client.global.icon_text>
                    </li>
                    <li class="flex items-center gap-2">
                        <x-client.global.icon_text
                            image_src="{{asset('assets/icons/paw.svg')}}"
                            image_alt="{!! __('global.paw_icon') !!}">
                            {{$this->animal->coat}}
                        </x-client.global.icon_text>
                    </li>
                </ul>
                <article class="mb-8 md:mb-0">
                    <h4 class="text-2xl mb-2">{!! __('client/animals.character_title') !!}</h4>
                    <p>{{$this->animal->temperament}}</p>
                </article>
            </div>
            <div class="md:w-1/2 relative">
                <img src="{{asset('assets/images/max.jpg')}}"
                     alt="{!! __('client/animals.animal_image_alt', ['name' => $this->animal->name]) !!}"
                     class="w-full h-full rounded-4xl">
            </div>
        </div>
        <div class="w-fit mx-auto">
            <x-client.global.cta
                route=""
                title="">
                Modifier
            </x-client.global.cta>
        </div>
    </section>
</div>
