<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ajouter un membre')]
class extends Component {
    //
};
?>

<div class="grid grid-cols-10 gap-4">
    <form action="" method="post" class="col-span-full flex flex-col gap-8">
        <div class="flex justify-between gap-4">
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.input
                    name="lastname"
                    placeholder="Doe">
                    {!! __('admin/members.lastname') !!}
                </x-client.form.input>
                <x-client.form.input
                    name="email"
                    type="email"
                    placeholder="john@doe.com">
                    {!! __('admin/global.email') !!}
                </x-client.form.input>
                <x-client.form.input
                    name="password"
                    {{--type="password"--}}
                    placeholder=""
                >
                    {!! __('admin/members.password_temporary') !!}
                </x-client.form.input>
            </fieldset>
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.input
                    name="firstname"
                    placeholder="John">
                    {!! __('admin/members.firstname') !!}
                </x-client.form.input>
                <x-client.form.input
                    name="telephone"
                    type="telephone"
                    placeholder="john@doe.com">
                    {!! __('admin/global.telephone') !!}
                </x-client.form.input>
                <x-client.form.select
                    name="role"
                    :options="[
    ['value' => 'volunteer', 'trad' => __('admin/global.volunteer')],
]">
                    {!! __('admin/members.role') !!}
                </x-client.form.select>
            </fieldset>
        </div>
        <fieldset class="flex justify-between gap-4">
            <legend class="text-2xl mb-4">Ses disponibilités <span class="text-secondary">*</span></legend>
            <div class="w-1/2 flex flex-col gap-4">
                <x-client.form.checkbox
                    day="{{__('admin/dispo.monday')}}"
                />
                <x-client.form.checkbox
                    day="{{__('admin/dispo.tuesday')}}"
                />
                <x-client.form.checkbox
                    day="{{__('admin/dispo.wednesday')}}"
                />
                <x-client.form.checkbox
                    day="{{__('admin/dispo.thursday')}}"
                />
            </div>
            <div class="w-1/2 flex flex-col gap-4">
                <x-client.form.checkbox
                    day="{{__('admin/dispo.friday')}}"
                />
                <x-client.form.checkbox
                    day="{{__('admin/dispo.saturday')}}"
                />
                <x-client.form.checkbox
                    day="{{__('admin/dispo.sunday')}}"
                />
            </div>
        </fieldset>
        <div class="mx-auto w-fit">
            <x-client.global.button
                title="{{__('admin/members.add_title')}}"
            >
                {!! __('admin/forms.add') !!}
            </x-client.global.button>
        </div>
    </form>
</div>
