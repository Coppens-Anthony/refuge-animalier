<?php

use App\Enums\Adoptions;
use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

new class extends Component {
    public $month;
    public $year;
    public $start;
    public $end;

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;

        $this->start = Carbon::create($this->year, $this->month)->startOfMonth();
        $this->end = Carbon::create($this->year, $this->month)->endOfMonth();
    }

    public function changeMonth($direction)
    {
        if ($direction === 'prev') {
            if ($this->month === 1) {
                $this->month = 12;
                $this->year--;
            } else {
                $this->month--;
            }
        } else {
            if ($this->month === 12) {
                $this->month = 1;
                $this->year++;
            } else {
                $this->month++;
            }
        }

        $this->start = Carbon::create($this->year, $this->month)->startOfMonth();
        $this->end = Carbon::create($this->year, $this->month)->endOfMonth();
    }

    #[Computed]
    public function animals()
    {
        return Animal::whereBetween('created_at', [$this->start, $this->end])->count();
    }

    #[Computed]
    public function adoptions()
    {
        return Adoption::where('status', Adoptions::FINISHED)
            ->whereBetween('created_at', [$this->start, $this->end])
            ->count();
    }

    #[Computed]
    public function animalsAdoptable()
    {
        return Animal::where('status', Status::ADOPTABLE)
            ->whereBetween('created_at', [$this->start, $this->end])
            ->count();
    }

    public function downloadPDF()
    {
        $file = Pdf::loadView('pdf.stats', [
            'animals' => $this->animals,
            'adoptions' => $this->adoptions,
            'animalsAdoptable' => $this->animalsAdoptable,
            'month' => $this->month,
            'year' => $this->year,
        ]);

        return response()->streamDownload(
            fn() => print($file->output()),
            'statistiques-' . (Carbon::create($this->year, $this->month)->locale(App::getLocale())->translatedFormat('F-Y')) . '.pdf'
        );
    }
};
?>

<div class="col-span-full sx:col-span-5 md:col-span-3 border-1 border-primary px-4 rounded-2xl">
    <section class="mt-4 flex flex-col gap-4">
        <h3>{!! __('admin/dashboard.stats') !!}</h3>
        <div class="flex items-center justify-between ">
            <div class="flex gap-2 font-bold">
                <button wire:click="changeMonth('prev')" class="cursor-pointer">
                    <
                </button>

                <p>{{ ucfirst(Carbon::create($year, $month)->locale(App::getLocale())->translatedFormat('F Y')) }}</p>

                <button wire:click="changeMonth('next')"
                        @if($year > now()->year || ($year == now()->year && $month >= now()->month))
                            disabled
                        class="hidden"
                        @else
                            class="cursor-pointer"
                    @endif>
                    >
                </button>
            </div>
            <button wire:click="downloadPDF">
                <img src="{{asset('assets/icons/download.svg')}}" alt="{!! __('admin/dashboard.download_icon') !!}"
                     class="cursor-pointer">
            </button>
        </div>

        <div>
            <ul class="flex flex-col gap-8">
                <li class="flex justify-center">
                    <x-client.home.stat
                        title="{!! __('global.collected_animals') !!}"
                        :number="$this->animals"
                        image_src="{{ asset('assets/icons/home.svg') }}"
                        image_alt="{!! __('global.home_icon') !!}"
                    />
                </li>
                <li class="flex justify-center">
                    <x-client.home.stat
                        title="{!! __('global.adoptions') !!}"
                        :number="$this->adoptions"
                        image_src="{{ asset('assets/icons/heart.svg') }}"
                        image_alt="{!! __('global.heart_icon') !!}"
                    />
                </li>
                <li class="flex justify-center">
                    <x-client.home.stat
                        title="{!! __('global.animals_searching_family') !!}"
                        :number="$this->animalsAdoptable"
                        image_src="{{ asset('assets/icons/paws.svg') }}"
                        image_alt="{!! __('global.paws_icon') !!}"
                    />
                </li>
            </ul>
        </div>
    </section>
</div>
