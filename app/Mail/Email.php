<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $viewP;
    public $subjectP;
    public $slug;

    public function __construct($viewP, $subjectP, $slug)
    {
        $this->viewP = $viewP;
        $this->subjectP = $subjectP;
        $this->slug = $slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subjectP)->withSwiftMessage(function ($message){
            $message->getHeaders()->addTextHeader(
                'X-SMTPAPI', json_encode(['category' => $this->slug])
            );
        })->html($this->viewP);
    }
}
