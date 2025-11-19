@props(['name', 'class' => '', 'options'])

<div class="flex flex-col gap-2 {{$class}}">
    <label for="{{$name}}" class="font-bold">{{$slot}}</label>
    <select id="{{$name}}" name="{{$name}}" class="rounded-4xl border-primary border-3 p-4 cursor-pointer">
        @foreach($options as $option)
            <option value="{{ $option['value'] }}">
                {{ $option['trad'] }}
            </option>
        @endforeach
    </select>
</div>
