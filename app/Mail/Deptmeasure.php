<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Deptmeasure extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $measure, $dept;
    public function __construct($measure, $user,$dept)
    {
        $this->measure = $measure;
        $this->user = $user;
        $this->dept = $dept;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.deptmeasure')->subject('Department Measure');
    }
}
