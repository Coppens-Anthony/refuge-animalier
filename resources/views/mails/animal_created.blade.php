@component('mail::message')
    {{$user->firstname . ' ' . $user->lastname}} vient d'ajouter un nouvel animal ({{$animal->name}}).

    Rendez-vous sur la fiche afin de la publier ou de la modifier.

    @component('mail::button', ['url' => 'https://admin.lespattesheureuses.test/animals/'.$animal->id.'/edit'])
        Accéder à {{$animal->name}}
    @endcomponent

    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
