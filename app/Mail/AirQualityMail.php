<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\Air;

class AirQualityMail extends Mailable
{
    public $air;

    public function __construct(Air $air)
    {
        $this->air = $air;
    }

    public function build()
    {
        return $this->subject('Peringatan Kualitas Udara Buruk!')
                    ->view('emails.air_quality')
                    ->with(['air' => $this->air]);
    }
}
