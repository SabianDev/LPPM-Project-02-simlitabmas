<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProposalReviewCompletedNotification extends Notification
{
    use Queueable;

    public $proposal;
    public $reviewStatus;
    public $reviewer;

    public function __construct($proposal, $reviewStatus, $reviewer)
    {
        $this->proposal = $proposal;
        $this->reviewStatus = $reviewStatus; // misalnya "accepted" atau "not accepted"
        $this->reviewer = $reviewer;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $message = ($this->reviewStatus == 'Approved')
            ? 'Hasil review proposal diterima.'
            : 'Hasil review proposal tidak diterima.';

        return [
            'message' => $message . ' (Dari: ' . $this->reviewer->name . ')',
            'proposal_id' => $this->proposal->id,
            'review_status' => $this->reviewStatus,
        ];
    }
}