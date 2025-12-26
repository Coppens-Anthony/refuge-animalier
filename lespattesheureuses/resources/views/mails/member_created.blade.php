@component('mail::message')
    # Création de votre profil pour Les Pattes Heureuses

    Je vous invite à vous connecter à l'application et de changer immédiatement votre mot de passe.
    (Mot de passe provisoire : 'password').

    @component('mail::button', ['url' => 'https://admin.lespattesheureuses.test/members/'.$user->id.'/edit'])
        Accéder à mon compte
    @endcomponent

    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
