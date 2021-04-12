<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Rejection extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $msg, $user;

    public function __construct($message, $user)
    {
        $this->msg = $message;
        $this->user = $user;
    }


    public function build()
    {
        return $this->view('email.rejected')->subject('Data Rejections');
    }
}
