@props(['route', 'title', 'reverse' => false])

<button type="submit"
        title="{{$title}}"
        class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0
   bg-primary border-primary  hover:bg-white cursor-pointer">
    {{$slot}}
</button>
