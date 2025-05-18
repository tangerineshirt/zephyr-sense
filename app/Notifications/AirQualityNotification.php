<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AirQualityNotification extends Notification
{
    public $airQuality;
    public $message;

    // Constructor untuk mengambil parameter dari controller
    public function __construct($airQuality, $message)
    {
        $this->airQuality = $airQuality;
        $this->message = $message;
    }

    // Pilih saluran untuk notifikasi (email)
    public function via($notifiable)
    {
        return ['mail'];  // Menentukan bahwa ini untuk email
    }

    // Menyusun tampilan email
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Notifikasi Kualitas Udara')
                    ->line($this->message)  // Menampilkan pesan
                    ->action('Lihat Detail', url('/'));  // Link ke detail jika perlu
    }
}
