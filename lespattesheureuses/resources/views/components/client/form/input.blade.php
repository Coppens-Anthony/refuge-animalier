@props(['name', 'type' => 'text', 'placeholder' => '' , 'isRequired' => true, 'class' => '', 'isSearch' => false, 'value' => ''])

<div class="flex flex-col gap-2 {{$class}} relative">
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

    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}"
           value="{{@old($name) ?? $value}}" {{ $attributes }}
           @if($isRequired)
               required
           @endif
           class="rounded-xl border-primary border-3 p-2 leading-0 @if($isSearch) pl-10 @endif">
    @if($isSearch)
        <img src="{{asset('assets/icons/search.svg')}}" alt="{!! __('global.search_icon') !!}"
             class="absolute bottom-2.5 left-4">
    @endif
</div>
