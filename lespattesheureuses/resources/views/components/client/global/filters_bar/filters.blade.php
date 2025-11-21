<form action="" method="post" class="grid grid-3 gap-2 md:flex md:gap-6">
    <x-client.form.input
        type="search"
        name="search"
        placeholder="Max"
        isRequired="{{false}}"
        isSearch="{{true}}"
        class="md:w-2/3 col-span-3">
        {!! __('global.search') !!}
    </x-client.form.input>
    <x-client.form.select
        name="specie"
        class="md:w-1/3 col-span-2"
        :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => 'dog', 'trad' => __('global.dog')],
    ['value' => 'cat', 'trad' => __('global.cat')],
]">
        {!! __('client/animals.specie') !!}
    </x-client.form.select>

    <label for="filters"
           class="col-span-1 rounded-4xl relative md:w-1/8 h-[2.6rem] md:h-[2.6rem] mt-auto border-primary border-3 p-4 flex items-center justify-center cursor-pointer duration-200 hover:bg-primary">
        <img src="{{asset('assets/icons/filters.svg')}}" alt="{!! __('global.message') !!}"
             class="absolute top-[50%] left-[50%] -translate-1/2 transform origin-center">
    </label>
    <input type="checkbox" name="filters" id="filters" class="sr-only peer">
    <label for="filters"
           class="cursor-pointer fixed inset-0 bg-black/50 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible transition z-90"></label>
    <div
        class="opacity-0 invisible peer-checked:opacity-100 peer-checked:visible duration-300  p-6 w-[80%] md:w-1/2 lg:w-1/3 mx-auto h-auto fixed z-100 top-[50%] left-[50%] -translate-1/2 transform origin-center bg-white border-primary border-2 rounded-2xl shadow-2xl">
        <p class="font-bold text-center border-b-2 mb-6 border-primary pb-4">Filtres</p>
        <fieldset class="grid grid-cols-2 gap-6">
            <x-client.form.select
                name="sexe"
                :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => 'male', 'trad' => __('client/animals.male')],
    ['value' => 'female', 'trad' => __('client/animals.female')],
]">
                {!! __('client/animals.sex') !!}
            </x-client.form.select>
            <x-client.form.select
                name="age"
                :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => '0_1', 'trad' => __('client/animals.0_1')],
    ['value' => '1_3', 'trad' => __('client/animals.1_3')],
    ['value' => '3_6', 'trad' => __('client/animals.3_6')],
    ['value' => '6_10', 'trad' => __('client/animals.6_10')],
    ['value' => 'more_10', 'trad' => __('client/animals.more_10')],
]">
                {!! __('client/animals.age') !!}
            </x-client.form.select>
            <x-client.form.select
                name="breed"
                :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => 'german_shepard', 'trad' => 'Berger allemand'],
    ['value' => 'teckel', 'trad' => 'Teckel'],
]">
                {!! __('client/animals.breed') !!}
            </x-client.form.select>
            <x-client.form.select
                name="coat"
                :options="[
    ['value' => 'all', 'trad' => __('global.all')],
    ['value' => 'fire', 'trad' => 'Feu'],
    ['value' => 'brown', 'trad' => 'Brun'],
]">
                {!! __('client/animals.coat') !!}
            </x-client.form.select>
            <div class="col-span-2 flex flex-col md:flex-row justify-end gap-4">
                <x-client.global.button
                    route=""
                    title=""
                    reverse="{{true}}">
                    Réinitialiser
                </x-client.global.button>
                <x-client.global.button
                    route=""
                    title="">
                    Enregistrer
                </x-client.global.button>
            </div>
        </fieldset>
    </div>
</form>


