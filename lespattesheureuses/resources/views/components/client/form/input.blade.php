@props(['name', 'type' => 'text', 'placeholder' , 'isRequired' => true, 'class' => ''])

<div class="flex flex-col gap-2 {{$class}}">
    <label for="{{$name}}" class="font-bold">{{$slot}}
        @if($isRequired)
            <span class="text-secondary">*</span>
        @endif
    </label>
    <input type="{{$type}}" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}"
           @if($isRequired)
               required
           @endif
           class="font-nunito rounded-4xl border-primary border-3 p-4 ">
</div>
