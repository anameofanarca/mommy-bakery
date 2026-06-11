<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOTPNotification extends Notification
{
    use Queueable;

    protected $otp;

    // 1. Tangkap kode OTP dari Controller saat fungsi ini dipanggil
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    // 2. Tentukan bahwa notifikasi ini dikirim via Email (mail)
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    // 3. Desain isi emailnya
// 3. Desain isi emailnya
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Kode OTP Mommy Bakery Kamu')
                    ->greeting('Halo!')
                    ->line('Kami menerima permintaan untuk melakukan reset password akun Mommy Bakery Anda.')
                    ->line('Berikut adalah kode OTP Anda untuk melanjutkan:')
                    ->line('## ' . $this->otp) // Menggunakan format Markdown '##' agar teks berukuran besar (Header)
                    ->line('Kode ini rahasia dan hanya berlaku selama 1 menit.')
                    ->line('Jika Anda tidak merasa meminta kode ini, abaikan saja email ini.');
    }
}