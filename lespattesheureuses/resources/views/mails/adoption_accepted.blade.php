@component('mail::message')
    Félicitations ! Votre demande d'adoption a été acceptée.

    Bonjour {{ $adoption->adopter->name }},

    Nous avons le plaisir de vous informer que votre demande d'adoption pour {{ $adoption->animal->name }} a été acceptée !

    Vous pouvez dès lors venir au refuge durant ses heures d'ouvertures pour avancer dans les démarches.

@endcomponent
