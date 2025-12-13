@props(['name', 'class' => '', 'options', 'isRequired' => true])

<div class="flex flex-col gap-2 {{$class}}">
    <label for="{{$name}}" class="font-bold">{{$slot}}
        @if($isRequired)
            <span class="text-secondary">*</span>
        @endif
        @error($name)
        <small class="text-red-500">
            {{ $message }}
        </small>
        @enderror
    </label>

    <select id="{{$name}}" name="{{$name}}" class="rounded-xl border-primary border-3 p-2 cursor-pointer" {{$attributes}}>
        <option value="">{{__('global.to_select')}}</option>
        @foreach($options as $option)
            <option value="{{ $option['value'] }}">
                {{ $option['trad'] }}
            </option>
        @endforeach
    </select>
</div>
