@props(['route', 'title', 'reverse' => false])

<a href="{{$route}}"
   title="{{$title}}"
   class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0
   @if($reverse)
    bg-white border-primary hover:bg-primary
   @else
   bg-primary border-primary  hover:bg-white
    @endif
    ">
    {{$slot}}
</a>
