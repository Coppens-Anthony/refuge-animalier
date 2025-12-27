@props(['title', 'isReverse' => false, 'isDangerous' => false, 'type' => 'submit'])

<button type="{{$type}}"
        title="{{$title}}"
        {{$attributes}}
        class="px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 cursor-pointer
   {{$isDangerous ? 'bg-red-400 border-red-400  hover:bg-white "' : 'bg-primary border-primary  hover:bg-white'}}
   {{$isReverse ? 'bg-white border-primary  hover:bg-primary "' : 'bg-primary border-primary  hover:bg-white'}}
   ">
    {{$slot}}
</button>
