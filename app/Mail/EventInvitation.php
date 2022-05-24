<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventInvitation extends Mailable
{
    use Queueable, SerializesModels;
    private $event;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event,$user)
    {
        $this->event = $event;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $event = $this->event;
        $user = $this-> user;
        return $this->markdown('emails.event_invitation',compact('event','user'));
    }
}
