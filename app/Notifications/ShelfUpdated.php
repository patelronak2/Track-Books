<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ShelfUpdated extends Notification
{
    use Queueable;
	public $user;
	public $book;
	public $shelf;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $book, $shelf)
    {
        $this->user = $user;
		$this->book = $book;
		$this->shelf = $shelf;
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
            "book_id" => $this->book->id,
			"book_name" => $this->book->title,
			"user_id" => $this->user->id,
			"user_name" => $this->user->name,
			"shelf" => $this->shelf
        ];
    }
}
