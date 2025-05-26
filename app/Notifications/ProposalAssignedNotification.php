<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProposalAssignedNotification extends Notification
{
    use Queueable;

    public $proposal;
    public $adminUser;

    public function __construct($proposal, $adminUser)
    {
        $this->proposal = $proposal;
        $this->adminUser = $adminUser;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Proposal dengan ID: ' . $this->proposal->id . ' telah diassign ke kamu.',
            'from'    => $this->adminUser->name,
        ];
    }
}