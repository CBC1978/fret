<?php

namespace App\Mail\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OfferReceive extends Mailable
{
    use Queueable, SerializesModels;

    private $data = array(
        'prix'=>'',
        'description'=>'',
        'annonce'=>'',
        'name'=>'',
    );

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data['prix'] = $data['price'];
        $this->data['description'] = $data['description'];
        $this->data['announce'] = $data['announce'];
        $this->data['name'] = $data['sender'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Offre reçue',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.offerReceive',
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
