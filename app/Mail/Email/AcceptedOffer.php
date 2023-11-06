<?php

namespace App\Mail\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AcceptedOffer extends Mailable
{
    use Queueable, SerializesModels;

    private $data = array(
        'prix'=>'',
        'description'=>'',
        'name'=>'',
    );

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data['prix'] = $data['price'];
        $this->data['description'] = $data['description'];
        $this->data['name'] = $data['sender'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reponse Offre reçu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.acceptedOffer',
            with: ['data'=>$this->data]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
