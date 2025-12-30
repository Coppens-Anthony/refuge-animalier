@component('mail::message')
    Bonjour {{ $adoption->adopter->name }},

    Merci pour l’intérêt porté à {{ $adoption->animal->name }}.

    Après étude de votre demande, nous sommes au regret de vous informer que celle-ci n’a pas été retenue, cette décision ayant été prise dans l’intérêt du bien-être de l’animal.

    Nous restons disponibles si vous souhaitez envisager une autre adoption à l’avenir.

    Cordialement.
@endcomponent
