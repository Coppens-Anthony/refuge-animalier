@props(['isSubject' => true, 'action', 'method' => 'post', 'button_title'])

<form action="{{$action}}" method="{{$method}}" class="flex flex-col gap-6 w-full md:w-1/2">
    <x-client.form.input
        name="lastname"
        placeholder="Doe">
        {!! __('form.lastname') !!}
    </x-client.form.input>
    <x-client.form.input
        name="firstname"
        placeholder="John">
        {!! __('form.firstname') !!}
    </x-client.form.input>
    <x-client.form.input
        name="email"
        placeholder="john@doe.com"
        type="email">
        Email
    </x-client.form.input>
    <x-client.form.input
        name="telephone"
        placeholder="0123.65.34.98"
        type="telephone">
        {!! __('form.telephone') !!}
    </x-client.form.input>
    @if($isSubject)
        <x-client.form.input
            name="subject"
            placeholder="Renseignement">
            {!! __('form.subject') !!}
        </x-client.form.input>
    @endif
    <x-client.form.textarea
        name="message"
        placeholder="Je vous contacte afin de...">
        Message
    </x-client.form.textarea>
    <div class="mx-auto mt-8">
        <x-client.global.button
            route=""
            title="{{$button_title}}">
            {{$slot}}
        </x-client.global.button>
    </div>
</form>
