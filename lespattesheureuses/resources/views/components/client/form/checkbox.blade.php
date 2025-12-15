@props(['day'])

<div class="flex gap-4">
    <p class="font-semibold">{{ $day }} :</p>
    @foreach (['morning' => __('admin/dispo.morning'), 'afternoon' => __('admin/dispo.afternoon'), 'evening' => __('admin/dispo.evening')] as $key => $label)
        <div class="flex gap-2">
            <input type="checkbox" name="{{ $day}}[{{$key}}]" id="{{ $day}}[{{$key}}]" class="cursor-pointer">
            <label for="{{ $day}}[{{$key}}]" class="cursor-pointer">
                {{ $label }}
            </label>
        </div>
    @endforeach
</div>
