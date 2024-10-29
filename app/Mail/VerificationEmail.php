<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verificationLink = route('emails.verification', ['code' => $this->user->verification_code]);

        return $this->view('web.emails.verification') // Specify the view file for the email content
            ->subject('Verify Your Email Address')
            ->with([
                'verificationLink' => $verificationLink,
            ]);
    }
}
