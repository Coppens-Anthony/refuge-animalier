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
        <form action="" class="flex gap-4">
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
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.email'),__('admin/global.telephone'), __('admin/global.status')]">
            @foreach($this->members as $member)
                <tr class="hover:bg-primary-opacity cursor-pointer"
                    wire:click="goToMember({{ $member->id }})"
                    wire:key="animal-{{ $member->id }}"
                    title="Vers la fiche de {{$member->firstname . ' ' . $member->lastname}}">
                    <td class="py-2">
                        <img src="{{ asset('avatars/originals/'.$member->avatar) }}"
                             srcset="
                            {{asset('avatars/variants/300x300/'.$member->avatar)}} 300w,
                            {{asset('avatars/variants/600x600/'.$member->avatar)}} 600w,
                            {{asset('avatars/variants/900x900/'.$member->avatar)}} 900w,
                            {{asset('avatars/variants/1200x1200/'.$member->avatar)}} 1200w"
                             sizes="(max-width: 768px) 100vw, 50vw"
                             alt="{!! __('client/animals.animal_image_alt', ['name' => $member->firstname . ' ' . $member->lastname]) !!}"
                             class="w-12 h-12 rounded-full object-cover mx-auto">
                    </td>
                    <td class="py-2">{{$member->firstname . ' ' . $member->lastname}}</td>
                    <td class="py-2">{{$member->email}}</td>
                    <td class="py-2">{{$member->telephone}}</td>
                    <td class="py-2">{{$member->status}}</td>
                </tr>
            @endforeach
        </livewire:admin.global.table.table>

        <div class="mt-4">
            {{ $this->members->links() }}
        </div>
    </section>
</div>
