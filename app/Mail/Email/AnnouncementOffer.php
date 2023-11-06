<?php

namespace App\Mail\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnnouncementOffer extends Mailable
{
    use Queueable, SerializesModels;
    private $data = array(
        'origin'=>'',
        'destination'=>'',
        'description'=>'',
        'name'=>'',
    );

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data['name'] = $data['name'];
        $this->data['description'] = $data['description'];
        $this->data['origin'] = $data['origin'];
        $this->data['destination'] = $data['destination'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Annonce ajoutée'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.announcementOffer',
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
