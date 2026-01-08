@component('mail::message')
    {!! __('mail/adoption_accepted.congrats') !!}

    Hey {{ $adoption->adopter->name }},

    {!! __('mail/adoption_accepted.desc', ['name' => $adoption->animal->name]) !!}

    {!! __('mail/adoption_accepted.start_process') !!}

@endcomponent
