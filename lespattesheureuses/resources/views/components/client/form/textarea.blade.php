@props(['name', 'type' => 'text', 'placeholder', 'isRequired' => true])

<div class="flex flex-col gap-2">
    <label for="{{$name}}" class="font-bold">{{$slot}}
        @if($isRequired)
            <span class="text-secondary">*</span>
        @endif</label>
    <textarea id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}"
              @if($isRequired)
                  required
              @endif
              class="font-nunito rounded-4xl border-primary border-3 p-4 resize-none" rows="8"></textarea>
</div>
