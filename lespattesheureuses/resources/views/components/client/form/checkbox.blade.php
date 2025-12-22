@props(['day', 'label'])

<div class="flex gap-4">
    <p class="font-semibold">{{ $label }} :</p>
    @foreach (['morning' => __('admin/dispo.morning'), 'afternoon' => __('admin/dispo.afternoon'), 'evening' => __('admin/dispo.evening')] as $key => $labelTime)
        <div class="flex gap-2">
            <input type="checkbox" wire:model="availabilities.{{ $day }}.{{ $key }}" name="{{ $day}}[{{$key}}]"
                   id="{{ $day}}[{{$key}}]" class="cursor-pointer">
            <label for="{{ $day}}[{{$key}}]" class="cursor-pointer">{{ $labelTime }}</label>
        </div>
    @endforeach
</div>
