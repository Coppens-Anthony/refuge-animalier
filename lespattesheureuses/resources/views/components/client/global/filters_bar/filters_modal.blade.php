<div class="basic relative" id="filters">
    <template id="template">
        <form method="dialog" class="absolute top-7 right-6">
            <button class="close-dialog cursor-pointer" type="submit">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    stroke="#C6CCF8"
                    viewBox="0 0 16 16"
                    stroke-width="2"
                    role="img">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"
                    />
                </svg>
                <span class="visually-hidden">{!! __('global.close_modal') !!}</span>
            </button>
        </form>
    </template>
    <p class="basic__title">Filtres</p>
    <form>
        <fieldset class="basic__fieldset">
            <x-client.global.filters_bar.search_and_specie/>
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
        </fieldset>
        <div class="basic__buttons_container">
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
    </form>
</div>
