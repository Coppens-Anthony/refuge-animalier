@props(['isInCard' => true])

<p class="px-4 py-2 rounded-xl text-[0.75rem] md:text-[0.875rem] lg:text-[1rem] bg-secondary
   @if($isInCard)
   absolute top-2 right-2
   @endif
   ">
    {{$slot}}
</p>
