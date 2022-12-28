<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class SendEmailVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $code = $this->generateCode($notifiable);
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->line(Lang::get('Please use the code below to verify your email address.'))
            ->line(Lang::get("Verification Code: $code (The code would expire in an hour.)"))
            ->action(Lang::get('Verify Email Address'), $this->getUrl($code))
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }

    public function generateCode($notifiable): int
    {
        $code = mt_rand(100000, 999999);
        $notifiable->verification_code = $code;
        $notifiable->verification_code_expires_at = Carbon::now()->addHour()->toDateTimeString();
        $notifiable->save();
        return $code;
    }

    public function getUrl($code): string
    {
        return route('verification.verify', ['code', $code]);
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
