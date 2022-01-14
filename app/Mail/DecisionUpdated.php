<?php

namespace App\Mail;

use App\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DecisionUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $decision;
    public $claim;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($decision, Claim $claim)
    {
        $this->decision = $decision;
        $this->claim = $claim;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Your claim reports decision has updated!")
            ->markdown('emails.decision-updated');
    }
}