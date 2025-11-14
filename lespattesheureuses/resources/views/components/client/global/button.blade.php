@props(['route', 'title', 'reverse' => false, 'class'])

<a href="{{$route}}"
   title="{{$title}}"
   class="px-8 py-2 block rounded-xl duration-200 hover:duration-200 border-4 text-[0.75rem] md:text-[0.875rem] lg:text-[1rem]
   @if($reverse)
    bg-white border-primary hover:bg-primary
   @else
   bg-primary border-primary  hover:bg-white
    @endif
    ">
    {{$slot}}
</a>
