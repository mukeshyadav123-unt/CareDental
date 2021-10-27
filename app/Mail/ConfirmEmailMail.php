<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ConfirmEmailMail extends Mailable
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->subject("You've got an appointment")
            ->markdown('emails.confirm-email', $this->data);
    }
}
