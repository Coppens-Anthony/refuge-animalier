@props(['isInCard' => true])

<p class="px-4 py-2 rounded-xl bg-secondary
   @if($isInCard)
   absolute top-2 right-2
   @endif
   ">
    {{$slot}}
</p>
