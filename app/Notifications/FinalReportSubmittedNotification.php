<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FinalReportSubmittedNotification extends Notification
{
    use Queueable;

    public $penelitian;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($penelitian, $user)
    {
        $this->penelitian = $penelitian;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        // Kita gunakan channel database agar notifikasi tersimpan di tabel notifications.
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Penelitian "' . $this->penelitian->title . '" oleh ' . $this->user->name . ' sudah selesai dan final report telah dikirim.',
            'penelitian_id' => $this->penelitian->id,
        ];
    }
}
