<?php

use App\Enums\Members;
use App\Jobs\ProcessUploadedAvatar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public $memberId;
    public $lastname;
    public $firstname;
    public $email;
    public $telephone;
    public $oldPassword;
    public $password;
    public $avatar;
    public $currentAvatar;
    public $availabilities;

    public function mount()
    {
        $member = User::findOrFail($this->memberId);

        $this->currentAvatar = $member->avatar;
        $this->lastname = $member->lastname;
        $this->firstname = $member->firstname;
        $this->email = $member->email;
        $this->telephone = $member->telephone;

        $this->availabilities = $member->availabilities;
    }

    public function update()
    {
        $member = User::findOrFail($this->memberId);

        $validated = $this->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users,email,' . $member->id,
            'telephone' => 'regex:/^0[1-9](?:[\s\.]?[0-9]{2}){4}$/|required',
            'oldPassword' => 'required|min:8',
            'password' => 'nullable|min:8|different:oldPassword',
            'availabilities' => 'required|array',
            'avatar' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if (!Hash::check($validated['oldPassword'], $member->password)) {
            $this->addError('oldPassword', 'Mot de passe incorrect');
            return;
        }

        if ($this->avatar) {
            $new_original_file_name = uniqid() . '.' . config('avatars.avatar_type');

            $full_path_to_original = $this->avatar->storeAs(
                config('avatars.original_path'),
                $new_original_file_name
            );

            if ($full_path_to_original) {
                $validated['avatar'] = $new_original_file_name;
                ProcessUploadedAvatar::dispatchSync($full_path_to_original, $new_original_file_name);
            }
        }

        $member->update([
            'availabilities' => $validated['availabilities'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            ...(isset($validated['avatar']) ? ['avatar' => $validated['avatar']] : []),
        ]);


        if ($validated['password'] != null) {
            $member->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        session()->flash('success', __('admin/global.member_edited'));

        return redirect(route('show.members', $member->id));
    }
};
?>

<div class="col-span-full">
    <form wire:submit="update" class="col-span-full flex flex-col gap-8">
        @csrf
        <div class="flex flex-col gap-2 w-fit mx-auto text-center mb-12 font-bold">
            <input id="avatar" name="avatar" type="file" wire:model="avatar"
                   class="invisible absolute top-0 left-0 h-0 w-0"
                   accept="image/*">
            <label for="avatar"
                   class="w-[175px] h-[175px] bg-gray-200 hover:bg-gray-300 duration-300 hover:duration-300 relative rounded-2xl cursor-pointer border-dashed border-1 border-black">
                <img src="{{asset('assets/icons/file_input_paw.svg')}}"
                     alt="{!! __('admin/forms.add_animal_image_alt') !!}"
                     class="absolute top-1/2 left-1/2 -translate-1/2 origin-center">
                <p class="absolute -bottom-12 w-full -translate-1/2 origin-center left-1/2">{!! __('admin/forms.add_image') !!}
                    <span class="text-secondary"> *</span>
                    @error('avatar')
                    <small class="text-red-500 absolute -bottom-10 left-0">
                        {{ $message }}
                    </small>
                    @enderror</p>
                @if($this->avatar)
                    <img src="{{$this->avatar->temporaryUrl()}}" alt="{{__('admin/table.image_alt')}}"
                         class="object-cover absolute w-[175px] h-[175px] rounded-2xl top-0 left-0">
                @elseif($this->currentAvatar)
                    @if(str_starts_with($this->avatar, 'public/assets/images/'))
                        <img src="{{asset(str_replace('public/assets/', 'assets/', $this->avatar))}}"
                             alt="{!! __('admin/table.image_alt') !!}"
                             class="object-cover absolute w-[175px] h-[175px] rounded-2xl top-0 left-0">
                    @endif
                    <img src="{{Storage::url('avatars/originals/'.$this->currentAvatar)}}"
                         alt="{{__('admin/table.image_alt')}}"
                         class="object-cover absolute w-[175px] h-[175px] rounded-2xl top-0 left-0">
                @endif
            </label>
        </div>

        <div class="flex justify-between gap-4">
            <fieldset class="grid md:grid-cols-2 gap-4 w-full">

                <x-client.form.input wire:model="lastname" name="lastname">
                    {!! __('admin/members.lastname') !!}
                </x-client.form.input>

                <x-client.form.input wire:model="firstname" name="firstname">
                    {!! __('admin/members.firstname') !!}
                </x-client.form.input>

                <x-client.form.input wire:model="email" name="email" type="email">
                    {!! __('admin/global.email') !!}
                </x-client.form.input>

                <x-client.form.input wire:model="telephone" name="telephone">
                    {!! __('admin/global.telephone') !!}
                </x-client.form.input>

                <x-client.form.input wire:model="oldPassword" name="oldPassword" type="password">
                    {!! __('admin/members.password_temporary') !!}
                </x-client.form.input>

                <x-client.form.input
                    wire:model="password"
                    name="password"
                    type="password"
                    is-required="{{ false }}">
                    {!! __('admin/members.new_password') !!}
                </x-client.form.input>

            </fieldset>
        </div>

        <fieldset class="grid md:grid-cols-2 gap-2 md:gap-8 w-full">
            <legend class="text-2xl mb-4">
                Ses disponibilités <span class="text-secondary">*</span>
            </legend>

            <div class="flex flex-col gap-2">
                <x-client.form.checkbox label="{{__('admin/dispo.monday')}}" day="monday"/>
                <x-client.form.checkbox label="{{__('admin/dispo.tuesday')}}" day="tuesday"/>
                <x-client.form.checkbox label="{{__('admin/dispo.wednesday')}}" day="wednesday"/>
                <x-client.form.checkbox label="{{__('admin/dispo.thursday')}}" day="thursday"/>
            </div>

            <div class="flex flex-col gap-2">
                <x-client.form.checkbox label="{{__('admin/dispo.friday')}}" day="friday"/>
                <x-client.form.checkbox label="{{__('admin/dispo.saturday')}}" day="saturday"/>
                <x-client.form.checkbox label="{{__('admin/dispo.sunday')}}" day="sunday"/>
            </div>
        </fieldset>

        <div class="mx-auto w-fit">
            <x-client.global.button title="{{__('admin/members.edit_title')}}">
                {!! __('admin/forms.edit') !!}
            </x-client.global.button>
        </div>

    </form>
</div>

