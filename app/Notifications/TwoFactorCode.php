<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCode extends Notification implements ShouldQueue
{
    use Queueable;

    public $two_factor_code;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($two_factor_code)
    {
        $this->two_factor_code = $two_factor_code;
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
        // return (new MailMessage)
        return (new MailMessage)
                    // ->line('Your two factor code is '.$notifiable->two_factor_code)
                    ->line('Your two factor code is '.$this->two_factor_code)
                    ->action('Verify Here', route('verify.index'))
                    ->line('The code will expire in 10 minutes')
                    ->line('If you have not tried to login, ignore this message.');
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
