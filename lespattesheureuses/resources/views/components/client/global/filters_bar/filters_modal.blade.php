@php use App\Enums\Sex; @endphp
@props(['animals', 'species', 'breeds', 'coats'])

<div class="basic relative" id="filters">
    <template id="template">
        <form method="dialog" class="absolute top-7 right-6">
            <button class="close-dialog cursor-pointer" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" stroke="#C6CCF8" viewBox="0 0 16 16" stroke-width="2" role="img">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
                <span class="visually-hidden">{!! __('global.close_modal') !!}</span>
            </button>
        </form>
    </template>
    <p class="basic__title">Filtres</p>

    <form action="{{ route('client_animals') }}" method="GET">
        <fieldset class="basic__fieldset">
            <x-client.form.input
                type="search"
                name="search"
                placeholder="Max"
                value="{{ request('search') }}"
                :isRequired="false"
                :isSearch="true"
                class="col-span-2 sx:col-span-1">
                {!! __('global.search') !!}
            </x-client.form.input>

            <x-client.form.select
                :is-required="false"
                class="col-span-2 sx:col-span-1"
                name="specie"
                :options="$species"
                :selected="request('specie')">
                {!! __('client/animals.specie') !!}
            </x-client.form.select>

            <x-client.form.select
                :is-required="false"
                class="col-span-2 sx:col-span-1"
                name="breed"
                :options="$breeds"
                :selected="request('breed')">
                {!! __('client/animals.breed') !!}
            </x-client.form.select>

            <x-client.form.select
                :is-required="false"
                class="col-span-2 sx:col-span-1"
                name="sexe"
                :options="Sex::options()"
                :selected="request('sexe')">
                {!! __('client/animals.sex') !!}
            </x-client.form.select>

            <x-client.form.select
                :is-required="false"
                class="col-span-2 sx:col-span-1"
                name="age"
                :options="[
                    ['value' => '0_1', 'trad' => __('client/animals.0_1')],
                    ['value' => '1_3', 'trad' => __('client/animals.1_3')],
                    ['value' => '3_6', 'trad' => __('client/animals.3_6')],
                    ['value' => '6_10', 'trad' => __('client/animals.6_10')],
                    ['value' => 'more_10', 'trad' => __('client/animals.more_10')],
                ]"
                :selected="request('age')">
                {!! __('client/animals.age') !!}
            </x-client.form.select>

            <x-client.form.select
                :is-required="false"
                class="col-span-2 sx:col-span-1"
                name="coat"
                :options="$coats"
                :selected="request('coat')">
                {!! __('client/animals.coat') !!}
            </x-client.form.select>
        </fieldset>

        <div class="basic__buttons_container">
            <a href="{{ route('client_animals') }}">
                <x-client.global.button
                    title=""
                    :is-reverse="true"
                    type="button">
                    Réinitialiser
                </x-client.global.button>
            </a>
            <x-client.global.button
                title="">
                Appliquer
            </x-client.global.button>
        </div>
    </form>
</div>
