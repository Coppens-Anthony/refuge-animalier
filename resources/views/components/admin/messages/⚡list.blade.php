<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <ul class="flex flex-col gap-2">
        <livewire:admin.messages.message
            isAlert="{{true}}"
            title="{{__('admin/messages.request', ['name' => 'Max'])}}"
            desc="{{__('admin/messages.desc')}}"
        />
        <livewire:admin.messages.message
            title="{{__('admin/messages.request', ['name' => 'Max'])}}"
            desc="{{__('admin/messages.desc')}}"
        />
        <livewire:admin.messages.message
            isSeen="{{true}}"
            title="{{__('admin/messages.request', ['name' => 'Max'])}}"
            desc="{{__('admin/messages.desc')}}"
        />
    </ul>
</div>
