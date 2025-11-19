@props(['route', 'title', 'reverse' => false, 'class'])

<a href="{{$route}}"
   title="{{$title}}"
   class="px-8 py-2 block w-fit rounded-xl duration-200 hover:duration-200 border-4 mx-auto md:mx-0 text-center
   @if($reverse)
    bg-white border-primary hover:bg-primary
   @else
   bg-primary border-primary  hover:bg-white
    @endif
    ">
    {{$slot}}
</a>
