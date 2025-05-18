<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;  // Pastikan $message adalah string
    }

    public function build()
    {
        return $this->subject('Test Email from Laravel')
                    ->view('emails.test')  // Menggunakan view untuk body email
                    ->with('message', $this->message);  // Menyertakan data $message ke view
    }
}


