<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
	public $email;
	public $identifier;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $identifier)
    {
        $this->email = $email;
		$this->identifier = $identifier;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verify Email')->view('emails.verify');
    }
}
