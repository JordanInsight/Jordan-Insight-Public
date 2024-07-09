<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TourReservationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $reservationDetails;

    /**
     * Create a new message instance.
     *
     * @param array $reservationDetails
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
        return $this->subject('Tour Reservation Successful')
                    ->view('emails.tourReservationSuccess');
    }
}
