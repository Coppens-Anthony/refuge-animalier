<?php

use App\Enums\Status;
use App\Models\Animal;
use App\Models\Specie;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $term = '';
    public string $specieId = '';
    public string $status = '';

    #[Computed]
    public function animals()
    {
        return Animal::where('status', Status::PENDING)->when($this->term, function ($query) {
            $query->where('name', 'like', '%' . $this->term . '%');
        })
            ->when($this->specieId !== '', function ($query) {
                $query->whereHas('breed.specie', function ($q) {
                    $q->where('id', $this->specieId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    #[Computed]
    public function speciesOptions(): array
    {
        return array_merge(
            Specie::all()->map(fn($specie) => [
                'value' => $specie->id,
                'trad' => $specie->name,
            ])->toArray()
        );
    }

    public function goToAnimal($id)
    {
        return redirect()->route('edit.animals', $id);
    }
};
?>

<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4">
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
                name="specieId"
                class="w-full"
                wire:model.live="specieId"
                :options="$this->speciesOptions"
            >
                {{__('admin/global.specie')}}
            </x-client.form.select>
        </form>
        <livewire:admin.global.table.table
            :titles="[__('admin/global.avatar'), __('admin/global.name'),__('admin/global.specie'),__('admin/global.breed'), __('admin/global.sex'), __('admin/global.age')]">
            @foreach($this->animals as $animal)
                <tr class="table__tr"
                    wire:click="goToAnimal({{ $animal->id }})"
                    wire:key="animal-{{ $animal->id }}"
                    title="Vers la fiche de {{$animal->name}}">
                    <td class="avatar_td">
                        <span class="avatar_title">{{__('admin/global.avatar')}}</span>
                        <div class="avatar_container">
                            @if($animal->avatar)
                                <img src="{{ asset('avatars/originals/'.$animal->avatar) }}"
                                     srcset="
                    {{asset('avatars/variants/300x300/'.$animal->avatar)}} 300w,
                    {{asset('avatars/variants/600x600/'.$animal->avatar)}} 600w,
                    {{asset('avatars/variants/900x900/'.$animal->avatar)}} 900w,
                    {{asset('avatars/variants/1200x1200/'.$animal->avatar)}} 1200w"
                                     sizes="(max-width: 768px) 48px, 48px"
                                     alt="{!! __('client/animals.animal_image_alt', ['name' => $animal->name]) !!}"
                                     class="avatar">
                            @else
                                <div class="no_avatar">
                                    Avatar
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.name')}}</span>
                        <span class="font-medium">{{$animal->name}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.specie')}}</span>
                        <span>{{$animal->breed->specie->name}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.breed')}}</span>
                        <span>{{$animal->breed->name}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.sex')}}</span>
                        <span>{{$animal->sex->label()}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{{__('admin/global.age')}}</span>
                        <span>{{$animal->age()}}</span>
                    </td>
                </tr>
            @endforeach
        </livewire:admin.global.table.table>

        <div class="mt-4">
            {{ $this->animals->links() }}
        </div>
    </section>
</div>
