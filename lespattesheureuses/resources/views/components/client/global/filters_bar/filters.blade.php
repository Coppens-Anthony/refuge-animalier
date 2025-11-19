<form action="" class="flex gap-6">
    <x-client.form.input
        type="search"
        name="search"
        placeholder="Max"
        isRequired="{{false}}"
        isSearch="{{true}}"
        class="w-2/3">
        {!! __('global.search') !!}
    </x-client.form.input>
    <x-client.form.select
        name="specie"
        class="w-1/3"
        :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => 'dog', 'trad' => __('global.dog')],
    ['value' => 'cat', 'trad' => __('global.cat')],
]">
        {!! __('global.specie') !!}
    </x-client.form.select>


    <label for="filters"
           class="rounded-4xl relative w-1/8 h-[4rem] mt-auto border-primary border-3 p-4 flex items-center justify-center cursor-pointer duration-200 hover:bg-primary">
        <img src="{{asset('assets/icons/filters.svg')}}" alt="{!! __('global.message') !!}"
             class="absolute top-[50%] left-[50%] -translate-1/2 transform origin-center">
    </label>


</form>
