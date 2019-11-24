<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FriendRequestSent extends Notification
{
    use Queueable;
	public $sender_id;
	public $sender_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sender_id, $sender_name)
    {
        $this->sender_id = $sender_id;
		$this->sender_name = $sender_name;
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
            //
			"sender_id" => $this->sender_id,
			"sender_name" => $this->sender_name,
        ];
    }
}
