<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class RegistrationSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    public $username,$email,$roles;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->username = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles ->pluck('name') ->toArray() ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registration.successful');
    }
}
