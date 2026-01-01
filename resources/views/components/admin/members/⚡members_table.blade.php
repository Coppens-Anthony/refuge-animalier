<?php

use App\Enums\Members;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $term = '';
    public string $status = '';

    #[Computed]
    public function members()
    {
        return User::when($this->term, function ($query) {
            $query->where('firstname', 'like', '%' . $this->term . '%')
            ->orWhere('lastname', 'like', '%' . $this->term . '%');
        })
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy('created_at')
            ->paginate(10);
    }

    public function goToMember($id)
    {
        return redirect()->route('show.members', $id);
    }
};
?>

<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
        <h3 class="sr-only">{!!__('admin/members.members') !!}</h3>
        <form class="grid grid-cols-2 gap-4">
            <x-client.form.input
                name="search"
                type="search"
                class="w-full"
                placeholder="{{__('global.search')}}"
                wire:model.live.debounce="term"
            >
                {{__('global.search')}}
            </x-client.form.input>
            <x-client.form.select
                name="status"
                class="w-full"
                wire:model.live="status"
                :options="Members::options()"
            >
                {{__('admin/global.status')}}
            </x-client.form.select>
        </form>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.email'), __('admin/global.status')]">
            @foreach($this->members as $member)
                <tr class="table__tr"
                    wire:click="goToMember({{ $member->id }})"
                    wire:key="member-{{ $member->id }}"
                    title="Vers la fiche de {{$member->firstname . ' ' . $member->lastname}}">
                    <td class="avatar_td">
                        <span class="avatar_title">{{__('admin/global.avatar')}}</span>
                        <div class="avatar_container">
                            @if($member->avatar)
                                <img src="{{ Storage::disk('s3')->url('avatars/originals/'.$member->avatar) }}"
                                     srcset="
                    {{Storage::disk('s3')->url('avatars/variants/300x300/'.$member->avatar)}} 300w,
                    {{Storage::disk('s3')->url('avatars/variants/600x600/'.$member->avatar)}} 600w,
                    {{Storage::disk('s3')->url('avatars/variants/900x900/'.$member->avatar)}} 900w"
                                     sizes="(max-width: 768px) 48px, 48px"
                                     alt="{!! __('client/animals.animal_image_alt', ['name' => $member->firstname . ' ' . $member->lastname]) !!}"
                                     class="avatar">
                            @else
                                <div class="w-12 h-12 mx-auto">
                                    <img src="{{asset('assets/icons/pp.svg')}}" alt="{!! __('global.pp_icon') !!}">
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.name')}}</span>
                        <span class="font-medium">{{$member->firstname . ' ' . $member->lastname}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.email')}}</span>
                        <span>{{$member->email}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.status')}}</span>
                        <span>{{$member->status->label()}}</span>
                    </td>
                </tr>
            @endforeach
        </livewire:admin.global.table.table>

        <div class="mt-4">
            {{ $this->members->links() }}
        </div>
    </section>
</div>
