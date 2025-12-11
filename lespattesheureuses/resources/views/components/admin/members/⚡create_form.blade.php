<?php

use App\Enums\Members;
use App\Models\User;
use Livewire\Component;

new class extends Component {

    public string $lastname = '';
    public string $firstname = '';
    public string $email = '';
    public string $telephone = '';
    public string $password = '';

    public function store()
    {
        $validated = $this->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'email|required',
            'telephone' => 'regex:/^0[1-9](?:[\s\.]?[0-9]{2}){4}$/|required',
            'password' => 'required|min:8',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $validated['avatar'] = '';
        $validated['status'] = Members::VOLUNTEER;
        $validated['name'] = $validated['firstname'] . ' ' . $validated['lastname'];

        $user = User::create($validated);
        return redirect(route('show.members', $user->id));
    }
};
?>

<div class="col-span-full">
    <form wire:submit="store" class="col-span-full flex flex-col gap-8">
        @csrf
        <div class="flex justify-between gap-4">
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.input
                    wire:model="lastname"
                    name="lastname"
                    placeholder="Doe">
                    {!! __('admin/members.lastname') !!}
                </x-client.form.input>
                <x-client.form.input
                    wire:model="email"
                    name="email"
                    type="email"
                    placeholder="john@doe.com">
                    {!! __('admin/global.email') !!}
                </x-client.form.input>
                <x-client.form.input
                    wire:model="password"
                    name="password"
                    {{--type="password"--}}
                    placeholder=""
                >
                    {!! __('admin/members.password_temporary') !!}
                </x-client.form.input>
            </fieldset>
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.input
                    wire:model="firstname"
                    name="firstname"
                    placeholder="John">
                    {!! __('admin/members.firstname') !!}
                </x-client.form.input>
                <x-client.form.input
                    wire:model="telephone"
                    name="telephone"
                    type="telephone"
                    placeholder="0123 45 67 89">
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
