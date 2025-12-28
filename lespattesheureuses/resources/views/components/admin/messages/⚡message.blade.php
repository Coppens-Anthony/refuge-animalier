<?php

use Livewire\Component;

new class extends Component {
    public bool $isSeen = false;
    public bool $isAlert = false;
    public string $title;
    public string $desc;
};
?>

<div x-data="{open: false}" x-cloak>
    <li class="relative {{$isAlert ? 'hover:bg-red-300' : 'hover:bg-primary-opacity'}} rounded-xl p-2 cursor-pointer"
        @click="open = !open">
        <article class="p-2">
            <div class="flex flex-col gap-2 sx:flex-row justify-between items-center mb-2">
                <h3 class="relative flex items-center mr-auto gap-2 pl-8 before:absolute before:top-1/2 before:-translate-y-1/2 before:left-0
           before:w-4 before:h-4 before:rounded-full {{$isSeen ? '' : ($isAlert ? 'before:bg-red-500 font-bold' : 'before:bg-primary font-bold')}}">
                    {{$title}}
                    @if($isAlert)
                        <img src="{{asset('assets/icons/alert.svg')}}"  alt="" class="h-8 w-8">
                    @endif
                </h3>
                <small class="mr-auto ml-8 sx:mr-0 sx:ml-auto opacity-50">Il y a 4 heures</small>
            </div>
            <p class="ml-8 line-clamp-1">{{$desc}}</p>
        </article>
    </li>
    <livewire:admin.global.modal>
       <article>
           <h4 class="font-bold mb-4">Demande d'adoption pour Max</h4>
           <p>
               Sarah Dupont a réalisé une demande d’adoption pour Max. Vous pouvez analyser la demande et l’accepter ou la refuser.
           </p>
           <div class="flex flex-col md:flex-row gap-6 w-fit mt-5.5 ml-auto mb-2">
               <button @click="open = false"
                   class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0    bg-white border-primary hover:bg-primary">
                   Fermer
               </button>
               <x-client.global.cta
                title=""
                route=""
               >
                   Voir la fiche
               </x-client.global.cta>
           </div>
           <p class="text-[0.8rem] opacity-50 underline cursor-pointer">Laissez le message non lu</p>
       </article>
    </livewire:admin.global.modal>
</div>
