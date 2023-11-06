<?php

namespace App\Mail\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferReceives extends Mailable
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
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data['prix'] = $data['price'];
        $this->data['description'] = $data['description'];
        $this->data['announce'] = $data['announce'];
        $this->data['name'] = $data['sender'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.offerReceive')
            ->subject('Offre reçue')
            ->with(['data'=>$this->data]);
    }
}
