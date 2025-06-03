<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewJobNotification extends Notification
{
    use Queueable;

    protected $jobTitle;
    protected $jobId;

    public function __construct($jobTitle, $jobId)
    {
        $this->jobTitle = $jobTitle;
        $this->jobId = $jobId;
    }

    // Send via database
    // public function via($notifiable)
    // {
    //     return ['database'];
    // }

    public function via(object $notifiable): array
    {
        return ['database', 'mail']; // store in DB + send email
    }


    // What gets stored in the "notifications" table
    public function toDatabase($notifiable)
    {
        return [
            'message' => "A new job '{$this->jobTitle}' has been posted.",
            'url' => route('jobs.show', $this->jobId)
        ];
    }
}
