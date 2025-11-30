<?php

use Livewire\Component;

new class extends Component {
    public bool $isSeen = false;
    public string $title;
    public string $desc;
};
?>

<div>
    <li class="relative">
        <a href="" title="{{__('admin/messages.see_message')}}" class="absolute top-0 left-0 h-full w-full hover:bg-primary-opacity rounded-xl p-2 cursor-pointer"></a>
        <article class="p-2">
            <div class="flex justify-between items-center mb-2">
                <h3 class="relative pl-8 before:absolute before:top-1/2 before:-translate-y-1/2 before:left-0
           before:w-4 before:h-4 before:rounded-full before:border-2 before:border-primary {{$isSeen ? '' : 'before:bg-primary font-bold'}} before:block before:content-['']">
                    {{$title}}
                </h3>
                <small class="opacity-50">Il y a 4 heures</small>
            </div>
            <p class="ml-8 line-clamp-1">{{$desc}}</p>
        </article>
    </li>
</div>
