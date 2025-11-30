<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Ajouter un animal')]
class extends Component {
    //
};
?>

<div class="grid grid-cols-10 gap-4">
    <form action="" method="post" class="col-span-full flex flex-col gap-8">
        <div class="flex flex-col gap-2 w-fit mx-auto text-center mb-6 font-bold">
            <input id="avatar" name="avatar" type="file" class="invisible absolute top-0 left-0 h-0 w-0" accept="image/*">
            <label for="avatar" class="w-[175px] h-[175px] bg-gray-200 hover:bg-gray-300 duration-300 hover:duration-300 relative rounded-2xl cursor-pointer border-dashed border-1 border-black">
                <img src="{{asset('assets/icons/file_input_paw.svg')}}" alt="{!! __('admin/forms.add_animal_image_alt') !!}" class="absolute top-1/2 left-1/2 -translate-1/2 origin-center">
               <p class="absolute -bottom-12 w-full -translate-1/2 origin-center left-1/2">{!! __('admin/forms.add_image') !!}<span class="text-secondary"> *</span></p>
            </label>
        </div>
        <div class="flex justify-between gap-4">
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.input
                    name="name"
                    placeholder="Max">
                    {!! __('admin/global.name') !!}
                </x-client.form.input>
                <x-client.form.select
                    name="specie"
                    :options="[
    ['value' => 'dog', 'trad' => __('global.dog')],
    ['value' => 'cat', 'trad' => __('global.cat')],
]"
                >
                    {!! __('admin/global.specie') !!}
                </x-client.form.select>
                <x-client.form.select
                    name="breed"
                    :options="[
    ['value' => 'dog', 'trad' => __('global.dog')],
    ['value' => 'cat', 'trad' => __('global.cat')],
]"
                >
                    {!! __('admin/global.breed') !!}
                </x-client.form.select>
                <x-client.form.input
                    name="age"
                    placeholder="2 ans"
                >
                    {!! __('admin/global.age') !!}
                </x-client.form.input>
                <x-client.form.input
                    name="sex"
                    placeholder="Mâle"
                >
                    {!! __('admin/global.sex') !!}
                </x-client.form.input>
            </fieldset>
            <fieldset class="w-1/2 flex flex-col gap-4">
                <x-client.form.input
                    name="coat"
                    placeholder="Feu"
                >
                    {!! __('admin/global.coat') !!}
                </x-client.form.input>
                <x-client.form.input
                    name="vaccines"
                    placeholder="Aucun"
                >
                    {!! __('admin/global.vaccines') !!}
                </x-client.form.input>
                <x-client.form.textarea
                    name="temperament"
                    placeholder="C’est un chien très affectueux qui adore la compagnie des humains. Il aime les balades et s’entend bien avec les autres chiens. Un peu méfiant au début, mais il devient vite un vrai pot de colle une fois en confiance."
                >
                    {!! __('admin/global.temperament') !!}
                </x-client.form.textarea>
            </fieldset>
        </div>
        <div class="mx-auto w-fit">
            <x-client.global.button
                title="{!! __('admin/forms.add_animal_title') !!}"
            >
                {!! __('admin/forms.add') !!}
            </x-client.global.button>
        </div>
    </form>
</div>
