<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Adopter;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public $adoption;
    public $adopters;
    public $animals;
    public $animal;
    public $adopterId;
    public $animalId;
    public $message;
    public $adoptionStatus = '';
    public string $term = '';

    public function mount()
    {
        $this->animals = Animal::where('status', Status::ADOPTABLE)->get();
        $this->adopters = Adopter::all();
    }

    #[Computed]
    public function adoptions()
    {
        return Adoption::when($this->term, function ($query) {
            $query->whereHas('animal', function ($q) {
                $q->where('name', 'like', '%' . $this->term . '%');
            })
                ->orWhereHas('adopter', function ($q) {
                    $q->where('name', 'like', '%' . $this->term . '%');
                });
        })
            ->when($this->adoptionStatus !== '', function ($query) {
                $query->where('status', $this->adoptionStatus);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    #[Computed]
    public function animalsOptions(): array
    {
        return $this->animals->map(fn($animal) => [
            'value' => $animal->id,
            'trad' => $animal->name,
        ])->toArray();
    }

    #[Computed]
    public function adoptersOptions(): array
    {
        return $this->adopters->map(fn($adopter) => [
            'value' => $adopter->id,
            'trad' => $adopter->name,
        ])->toArray();
    }

    public function store()
    {
        $validated = $this->validate([
            'animalId' => 'required|exists:animals,id',
            'adopterId' => 'required|exists:adopters,id',
            'message' => 'required'
        ]);

        $adoption = Adoption::create([
            'animal_id' => $validated['animalId'],
            'adopter_id' => $validated['adopterId'],
            'message' => $validated['message'],
            'status' => Adoptions::IN_PROGRESS,
        ]);

        Animal::where('id', $validated['animalId'])->update(['status' => Status::IN_ADOPTION]);

        session()->flash('success', __('admin/global.adoption_created'));
        return redirect(route('show.adoptions', $adoption->id));
    }

    public function goToAdoption($id)
    {
        return redirect()->route('show.adoptions', $id);
    }

};
?>
<div class="col-span-full">
    <section class="mb-4 flex flex-col gap-4 relative">
        @if(session('delete'))
            <div class="alert-delete">
                {{ session('delete') }}
            </div>
        @endif
        <div class="flex justify-end mt-4" x-data="{ open: false}" x-cloak>
            <h3 class="sr-only">{!!__('admin/nav.adoptions') !!}</h3>
            <div>
                <button
                    @click="open = true"
                    title="{{__('admin/global.add_adoption')}}"
                    class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 cursor-pointer bg-primary border-primary hover:bg-white">
                    {{__('admin/global.create_adoption')}}
                </button>
            </div>
            <livewire:admin.global.modal>
                <form wire:submit="store" class="flex flex-col gap-4">
                    <x-client.form.select
                        name="animalId"
                        wire:model="animalId"
                        :options="$this->animalsOptions"
                    >
                        {{__('admin/global.animal_name')}}
                    </x-client.form.select>
                    <x-client.form.select
                        name="adopterId"
                        wire:model="adopterId"
                        :options="$this->adoptersOptions"
                    >
                        {{__('admin/global.adopter_name')}}
                    </x-client.form.select>
                    <x-client.form.textarea
                        name="message"
                        wire:model="message"
                        placeholder="{{__('admin/global.message_placeholder')}}"
                        rows="4"
                    >
                        {{__('global.message')}}
                    </x-client.form.textarea>
                    <div class="flex gap-6 w-fit mt-5.5 ml-auto">
                        <p @click="edit = false"
                           class="px-8 cursor-pointer py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 bg-white border-primary hover:bg-primary">
                            {{__('admin/global.close')}}
                        </p>
                        <x-client.global.button
                            title="{{__('admin/forms.add_title')}}">
                            {{__('admin/forms.add')}}
                        </x-client.global.button>
                    </div>
                </form>
            </livewire:admin.global.modal>
        </div>

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
                name="adoptionStatus"
                class="w-full"
                wire:model.live="adoptionStatus"
                :options="Adoptions::options()"
            >
                {{__('admin/global.status')}}
            </x-client.form.select>
        </form>
            <livewire:admin.global.table.table
                :titles="[__('admin/global.animal_name'), __('admin/global.adopter_name'), __('admin/global.date'), __('admin/global.status')]">
                @foreach($this->adoptions as $adoption)
                    <tr class="table__tr"
                        wire:click="goToAdoption({{ $adoption->id }})"
                        wire:key="adoption-{{ $adoption->id }}"
                        title="Vers la fiche de {{$adoption->animal->name}}">
                        <td class="text_td">
                            <span class="title_td">{{__('admin/global.animal_name')}}</span>
                            <span class="font-medium">{{$adoption->animal->name}}</span>
                        </td>
                        <td class="text_td">
                            <span class="title_td">{{__('admin/global.adopter_name')}}</span>
                            <span>{{$adoption->adopter->name}}</span>
                        </td>
                        <td class="text_td">
                            <span class="title_td">{{__('admin/global.date')}}</span>
                            <span>{{$adoption->created_at->format('d-m-Y')}}</span>
                        </td>
                        <td class="text_td">
                            <span class="title_td">{{__('admin/global.status')}}</span>
                            <span>{{$adoption->status->label()}}</span>
                        </td>
                    </tr>
                @endforeach
            </livewire:admin.global.table.table>

        <div class="mt-4">
            {{ $this->adoptions->links() }}
        </div>

    </section>
</div>



