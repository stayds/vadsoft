<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Staffmeasure extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $measure;

    public function __construct($measure,$name)
    {
        $this->name = $name;
        $this->measure = $measure;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.staffmeasure')->subject('Staff Measure');
    }
}
