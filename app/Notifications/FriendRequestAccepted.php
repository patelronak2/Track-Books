<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FriendRequestAccepted extends Notification
{
    use Queueable;
	public $accepting_user_id;
	public $accepting_user_name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($accepting_user_id, $accepting_user_name)
    {
        //
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            "accepting_user_id" => $this->accepting_user_id;
			"accepting_user_name" => $this->accepting_user_name;
        ];
    }
}
