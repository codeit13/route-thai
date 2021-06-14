<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignUpOTP extends Mailable
{
    use Queueable, SerializesModels;
    
    public $otp;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $otp = $this->otp;
        return $this->view('email.signup-otp',compact('otp'));
    }
}