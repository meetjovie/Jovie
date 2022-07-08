<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ImportNotification extends Notification
{
    use Queueable;

    private $message;

    private $internalMessage;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $internalMessage = '', $data = [])
    {
        $this->message = $message;
        $this->internalMessage = $internalMessage;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        $content = [$this->message, $this->internalMessage, $this->data];

        return (new SlackMessage)->content(json_encode($content));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
