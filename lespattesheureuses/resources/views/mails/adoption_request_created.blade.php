@component('mail::message')
    # Demande d'adoption

    Une nouvelle demande d'adoption est arrivée !

    Il s'agit de {{$adoption->animal->name}} qui voudrait se faire adopter par {{$adoption->adopter->name}}.
    Voici ses informations :
    Email -> {{$adoption->adopter->email}},
    Téléphone -> {{$adoption->adopter->telephone}},
    Message -> {{$adoption->message}},

    @component('mail::button', ['url' => 'https://admin.lespattesheureuses.test/adoptions/'.$adoption->id])
        Accéder à la fiche de la demande pour l'accepter ou la refuser
    @endcomponent

    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
