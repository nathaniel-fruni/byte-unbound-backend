<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $verification_code;
    public $talks;

    public function __construct(string $verification_code, $talks)
    {
        $this->verification_code = $verification_code;
        $this->talks = $talks;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Registrácia úspešná')
            ->view('emails.registration_mail');
    }

}
