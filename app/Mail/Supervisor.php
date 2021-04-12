<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Supervisor extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $measure;

    public function __construct($user, $measure)
    {
        $this->user = $user;
        $this->measure = $measure;
    }


    public function build()
    {
        return $this->view('email.supervisor')->subject('Data Validation');
    }
}
