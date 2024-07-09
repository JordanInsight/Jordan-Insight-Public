<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $reservationDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservationDetails)
    {
        $this->reservationDetails = $reservationDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reservation Successful')
            ->view('emails.reservationSuccess');
            
    }
}
