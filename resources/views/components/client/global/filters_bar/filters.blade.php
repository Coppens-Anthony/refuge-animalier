@props(['animals', 'species', 'breeds', 'coats'])

<div>
    <div class="hidden w-fit ml-auto" id="no_js_search_specie">
        <button id="button_filters" class="bg-white border-primary  hover:bg-primary px-8 py-2 block w-fit rounded-xl duration-200 text-center hover:duration-200 border-4 mx-auto sx:mx-0 cursor-pointer">
            {{__('global.filters')}}
        </button>

    </div>
    <x-client.global.filters_bar.filters_modal
        :species="$species" :breeds="$breeds" :coats="$coats" :animals="$animals"
    />
</div>


