<form action="" method="post" class="grid grid-cols-2 gap-4 mb-4" id="filters_form">
    <x-client.form.input
        type="search"
        name="search"
        placeholder="Max"
        isRequired="{{false}}"
        isSearch="{{true}}"
        class="col-span-2 md:col-span-1">
        {!! __('global.search') !!}
    </x-client.form.input>
    <div class="flex justify-between col-span-2 gap-4 md:col-span-1">
        <x-client.form.select
            name="specie"
            class="w-full"
            isRequired="{{false}}"
            :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => 'dog', 'trad' => __('global.dog')],
    ['value' => 'cat', 'trad' => __('global.cat')],
]">
            {!! __('client/animals.specie') !!}
        </x-client.form.select>
        <button id="button_filters"
                class="hidden">
            <img src="{{asset('assets/icons/filters.svg')}}" alt="{!! __('global.message') !!}"
                 class="absolute top-[50%] left-[50%] -translate-1/2 transform origin-center">
        </button>
    </div>
</form>
