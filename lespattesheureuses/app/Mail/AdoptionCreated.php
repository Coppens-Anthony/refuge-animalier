<?php

namespace App\Mail;

use App\Models\Adoption;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class AdoptionCreated extends Mailable
{
    public function __construct(public Adoption $adoption){
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: $this->adoption->adopter->email,
            subject: 'Adoption\'s Request Created',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mails.adoption_request_created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
