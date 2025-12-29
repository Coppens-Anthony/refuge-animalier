@props(['name', 'options', 'selected' => ''])

<div class="relative" x-data="selectData_{{ $name }}($wire.entangle('{{ $name }}'))" x-init="setInitial({{$selected}})">
    <x-client.form.input
        type="search"
        name="{{$name}}_search"
        x-model="search"
        placeholder="{{__('global.to_select')}}"
        @click="showOptions"
        @search="clearSearch"
    >
        {{$slot}}
    </x-client.form.input>
    <svg
        class="w-3 h-3 absolute top-12 right-2"
        fill="none"
        stroke="black"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
    <div class="relative" x-show="optionsVisible" @click.away="hideOptions">
        <div
            class="absolute top-0 z-10 mt-1 w-full bg-white border border-primary rounded-lg shadow-lg max-h-60 overflow-y-auto flex flex-col gap-2 p-2">
            <template x-for="option in filteredOptions()">
                <a
                    @click.prevent="selectOption(option)"
                    x-html="highlight(option.label)"
                    class="cursor-pointer hover:bg-gray-200 p-2">
                </a>
            </template>
        </div>
    </div>

    <script>
        function selectData_{{ $name }}(livewireValue) {
            return {
                livewireValue: livewireValue,
                optionsVisible: false,
                search: "",
                selected: {
                    label: "",
                    value: ""
                },
                clearSearch() {
                    this.selected.value = '';
                    this.selected.label = '';
                    this.livewireValue = '';
                },
                setInitial(selected) {
                    selectedOption = this.options.find((option) => {
                        return option.value === selected
                    });
                    if (selectedOption !== undefined) {
                        this.selectOption(selectedOption);
                    }
                },
                showOptions() {
                    this.optionsVisible = true;
                },
                hideOptions() {
                    this.optionsVisible = false;
                },
                selectOption(option) {
                    this.selected = option;
                    this.hideOptions();
                    this.search = option.label;
                    this.livewireValue = option.value;
                },
                options: {!! $options->map(function($option) {
                    return [
                        'value' => $option->id,
                        'label' => $option->name,
                    ];
                })->values() !!},
                filteredOptions() {
                    return this.options.filter((option) => {
                        return option.label.toLowerCase().includes(this.search.toLowerCase());
                    });
                },
                highlight(value) {
                    var text = this.search.trim();
                    if (text === '') {
                        return value;
                    }
                    return value;
                }
            };
        }
    </script>
</div>


{{--Code qui vient de https://gist.github.com/saurabh85mahajan/a21a9673acdeedca063475207202a698.
Avec quelques modification afin de le rendre compatible avec mes besoins.--}}
