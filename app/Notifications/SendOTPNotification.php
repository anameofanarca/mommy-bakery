<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOTPNotification extends Notification
{
    use Queueable;

    protected $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Kode OTP Mommy Bakery Kamu')
            ->greeting('Halo!')
            ->line('Kami menerima permintaan verifikasi akun Mommy Catering & Bakery.')
            ->line('Berikut adalah kode OTP Anda:')
            ->line('## ' . $this->otp)
            ->line('Kode ini rahasia dan hanya berlaku dalam waktu terbatas.')
            ->line('Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini.');
    }
}