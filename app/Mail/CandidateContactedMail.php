<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\Translation\t;

class CandidateContactedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company)
    {
        $this->company = $company;
        $this->subject = "MZT: Notification";
    }


    /**
     * Build the message.
     *
     * @return
     */
    public function build()
    {
        return $this->view('emails.candidate-contacted')->with(['company' => $this->company]);
    }
}
