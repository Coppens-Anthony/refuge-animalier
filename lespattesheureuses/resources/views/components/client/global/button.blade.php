@props(['title', 'isDangerous' => false])

<button type="submit"
        title="{{$title}}"
        class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 cursor-pointer
   {{$isDangerous ? 'bg-red-400 border-red-400  hover:bg-white "' : 'bg-primary border-primary  hover:bg-white'}}
   ">
    {{$slot}}
</button>
