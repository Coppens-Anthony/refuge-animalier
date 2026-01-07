<?php

use App\Models\Animal;
use App\Enums\Status;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public string $term = '';
    public string $specieId = '';
    public string $status = '';

    #[Computed]
    public function animals()
    {
        return Animal::when($this->term, function ($query) {
            $query->where('name', 'like', '%' . $this->term . '%');
        })
            ->when($this->specieId !== '', function ($query) {
                $query->whereHas('breed.specie', function ($q) {
                    $q->where('id', $this->specieId);
                });
            })
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    #[Computed]
    public function speciesOptions(): array
    {
        return Specie::all()->map(fn($specie) => [
                'value' => $specie->id,
                'trad' => $specie->name,
            ])->toArray();
    }

    public function goToAnimal($id)
    {
        return redirect()->route('show.animals', $id);
    }

};
?>

<div class="col-span-full lg:col-span-7 border-1 border-primary px-4 rounded-2xl">
    <section class="mb-4 flex flex-col gap-4">
        <h3 class="mt-4">{!! __('admin/global.animals') !!}</h3>
        <form class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <x-client.form.input
                name="search"
                type="search"
                placeholder="{!! __('global.search') !!}"
                wire:model.live.debounce="term"
            >
                {!! __('global.search') !!}
            </x-client.form.input>
            <x-client.form.select
                name="specieId"
                wire:model.live="specieId"
                :options="$this->speciesOptions"
            >
                {!! __('admin/global.specie') !!}
            </x-client.form.select>
            <x-client.form.select
                name="status"
                wire:model.live="status"
                :options="Status::options()"
            >
                {!! __('admin/global.status') !!}
            </x-client.form.select>
        </form>
        <livewire:admin.global.table.table
            :titles="[
                __('admin/global.avatar'),
                __('admin/global.name'),
                __('admin/global.specie'),
                __('admin/global.status')
            ]">
            @foreach($this->animals as $animal)
                <tr class="table__tr"
                    wire:click="goToAnimal({{ $animal->id }})"
                    wire:key="animal-{{ $animal->id }}"
                    title="Vers la fiche de {{$animal->name}}">
                    <td class="avatar_td">
                        <span class="avatar_title">{!! __('admin/global.avatar') !!}</span>
                        <div class="avatar_container">
                            @if(str_starts_with($animal->avatar, 'public/assets/images/animals/'))
                                <img src="{{asset(str_replace('public/assets/', 'assets/', $animal->avatar))}}"
                                     alt="Photo de {{$animal->name}}"
                                     class="avatar">
                            @else
                                <img src="{{ Storage::url('avatars/originals/'.$animal->avatar) }}"
                                     srcset="
                {{Storage::url('avatars/variants/300x300/'.$animal->avatar)}} 300w,
                {{Storage::url('avatars/variants/600x600/'.$animal->avatar)}} 600w,
                {{Storage::url('avatars/variants/900x900/'.$animal->avatar)}} 900w"
                                     sizes="(max-width: 768px) 48px, 48px"
                                     alt="{!! __('client/animals.animal_image_alt', ['name' => $animal->name]) !!}"
                                     class="avatar">
                            @endif
                        </div>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{!! __('admin/global.name') !!}</span>
                        <span class="font-medium">{{$animal->name}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{!! __('admin/global.specie') !!}</span>
                        <span>{{$animal->breed->specie->name}}</span>
                    </td>
                    <td class="text_td">
                        <span class="title_td">{!! __('admin/global.status') !!}</span>
                        <span>{{$animal->status->label()}}</span>
                    </td>
                </tr>
            @endforeach
        </livewire:admin.global.table.table>

        <div class="mt-4">
            {{ $this->animals->links() }}
        </div>
    </section>
</div>

