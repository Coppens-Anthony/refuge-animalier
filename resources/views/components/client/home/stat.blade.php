@props(['image_src', 'image_alt', 'number', 'title'])

<article class="flex gap-2 items-center">
    <img src="{{$image_src}}" alt="{{$image_alt}}">
    <div class="flex flex-col">
        <p class="text-[2.5rem]">{{$number}}</p>
        <h3>{{$title}}</h3>
    </div>
</article>

