<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewLessonNotification extends Notification
{
    use Queueable;
    protected $task_id;
    protected $sender;
    protected $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task_id,$sender,$title)
    {
        $this->task_id=$task_id;
        $this->sender=$sender;
        $this->title=$title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task_id,
            'sender' => $this->sender,
            'title' => $this->title,
        ];
    }


}
