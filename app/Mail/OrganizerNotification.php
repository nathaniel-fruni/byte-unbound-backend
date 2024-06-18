<?php

// app/Mail/OrganizerNotification.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Talk;

class OrganizerNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $talks;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $talks)
    {
        $this->user = $user;
        $this->talks = $talks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Nová registrácia')
            ->view('emails.organizer_notification');
    }
}
