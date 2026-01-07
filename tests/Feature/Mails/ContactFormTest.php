<?php

use Illuminate\Support\Facades\Mail;

it('sends a mail when the user press the form button', function () {
    Mail::fake();
    $contactData = [
        'name' => 'Test',
        'email' => 'test@mail.com',
        'telephone' => '0123456789',
        'subject' => 'question',
        'message' => 'test test'
    ];

    $response = $this->post(route('client_contact.store'), $contactData);

    $response->assertSessionHas('success');
});
