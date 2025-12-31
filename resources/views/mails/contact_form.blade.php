@component('mail::message')
    Nouveau message de contact

    Vous avez reçu un nouveau message de {{ $validated['name'] }}.

    Email : {{ $validated['email'] }}
    Téléphone : {{ $validated['telephone'] }}
    Sujet : {{ $validated['subject'] }}

    ---

    Message :

    {{ $validated['message'] }}

    @component('mail::button', ['url' => 'mailto:' . $validated['email']])
        Répondre
    @endcomponent

    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
