@props(['number'])

<ul class="w-2/3 mx-auto flex flex-col gap-4 md:w-auto  md:grid md:grid-cols-3 md:gap-5.5 mb-5.5">
    @for($i = 0; $i < $number; $i++)
        <li>
            <x-client.global.item_card
                image_src="{{asset('assets/images/max.jpg')}}"
                image_alt=""
                status="Adoptable"
                name="Max"
                age="2 ans"
                specie="Berger allemand"/>
        </li>
    @endfor
</ul>
