<?php

use App\Enums\Members;
use App\Mail\MemberCreated;
use App\Models\User;
use Livewire\Component;

new class extends Component {

    public string $lastname = '';
    public string $firstname = '';
    public string $email = '';
    public string $telephone = '';
    public string $password = '';
    public array $availabilities;

    public function mount()
    {
        $this->availabilities = [
            'monday' => ['morning' => false, 'afternoon' => false, 'evening' => false],
            'tuesday' => ['morning' => false, 'afternoon' => false, 'evening' => false],
            'wednesday' => ['morning' => false, 'afternoon' => false, 'evening' => false],
            'thursday' => ['morning' => false, 'afternoon' => false, 'evening' => false],
            'friday' => ['morning' => false, 'afternoon' => false, 'evening' => false],
            'saturday' => ['morning' => false, 'afternoon' => false, 'evening' => false],
            'sunday' => ['morning' => false, 'afternoon' => false, 'evening' => false],
        ];
    }

    public function store()
    {
        $validated = $this->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'email|required|unique:users,email',
            'telephone' => 'regex:/^0[1-9](?:[\s\.]?[0-9]{2}){4}$/|required',
            'availabilities' => 'required|array'
        ]);
        $validated['password'] = bcrypt('password');
        $validated['avatar'] = '';
        $validated['status'] = Members::VOLUNTEER;
        $validated['availabilities'] = $this->availabilities;

        $user = User::create($validated);

        session()->flash('success', __('admin/global.member_created'));

        Mail::to($user->email)->queue(
            new MemberCreated($user)
        );

        return redirect(route('show.members', $user->id));
    }
};
?>

<div class="col-span-full">
    <form wire:submit="store" class="col-span-full flex flex-col gap-8">
        @csrf
        <div class="flex justify-between gap-4">
            <fieldset class="grid md:grid-cols-2 gap-4 w-full">
                <x-client.form.input
                    wire:model="lastname"
                    name="lastname"
                    placeholder="Doe">
                    {!! __('admin/members.lastname') !!}
                </x-client.form.input>
                <x-client.form.input
                    wire:model="firstname"
                    name="firstname"
                    placeholder="John">
                    {!! __('admin/members.firstname') !!}
                </x-client.form.input>
                <x-client.form.input
                    wire:model="email"
                    name="email"
                    type="email"
                    placeholder="john@doe.com">
                    {!! __('admin/global.email') !!}
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
        <fieldset class="grid md:grid-cols-2 gap-2 md:gap-8 w-full">
            <legend class="text-2xl mb-4">Ses disponibilités <span class="text-secondary">*</span></legend>
            <div class="flex flex-col gap-2">
                <x-client.form.checkbox
                    label="{{__('admin/dispo.monday')}}"
                    day="monday"
                />
                <x-client.form.checkbox
                    label="{{__('admin/dispo.tuesday')}}"
                    day="tuesday"
                />
                <x-client.form.checkbox
                    label="{{__('admin/dispo.wednesday')}}"
                    day="wednesday"
                />
                <x-client.form.checkbox
                    label="{{__('admin/dispo.thursday')}}"
                    day="thursday"
                />
            </div>
            <div class="flex flex-col gap-2">
                <x-client.form.checkbox
                    label="{{__('admin/dispo.friday')}}"
                    day="friday"
                />
                <x-client.form.checkbox
                    label="{{__('admin/dispo.saturday')}}"
                    day="saturday"
                />
                <x-client.form.checkbox
                    label="{{__('admin/dispo.sunday')}}"
                    day="sunday"
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
