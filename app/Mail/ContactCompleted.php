<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactCompleted extends Mailable
{
    use SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->contact['contact_email'])
        ->text('contact_completed_mail')
        ->subject(env('MAIL_COMPLETED_SUBJECT'));
    }
}
