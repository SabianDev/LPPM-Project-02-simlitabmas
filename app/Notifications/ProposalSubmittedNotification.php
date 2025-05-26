<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProposalSubmittedNotification extends Notification
{
    use Queueable;

    public $proposal;
    public $fromUser;

    public function __construct($proposal, $fromUser)
    {
        $this->proposal = $proposal;
        $this->fromUser = $fromUser;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Proposal baru diajukan dengan ID: ' . $this->proposal->id,
            'from'    => $this->fromUser->name,
        ];
    }
}
