<x-client.global.layout>
    <div class="flex flex-col md:flex-row gap-16 md:gap-30 items-start">
        <x-client.contact.info_section/>
        @if(session('success'))
            <div class="flex-1 bg-green-50 border border-green-200 rounded-lg p-8 text-center">
                <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <h3 class="text-2xl font-bold text-green-800 mb-2">
                    {!! __('global.success_contact_form') !!}
                </h3>
                <p class="text-green-700">
                    {!! __('global.success_contact_form_desc') !!}
                </p>
            </div>
        @else
            <x-client.contact.form
                action="{{route('client_contact.store')}}"
                button_title="{!! __('form.send_title') !!}">
                {!! __('form.send') !!}
            </x-client.contact.form>
        @endif
    </div>
</x-client.global.layout>
