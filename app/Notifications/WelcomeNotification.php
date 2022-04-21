<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed                                          $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('email.welcome.subject'))
            ->greeting(__('email.welcome.greeting', [
                'name' => $notifiable->name,
            ]))
            ->line(__('email.welcome.intro', [
                'app' => localized_settings('site.title'),
            ]))
            ->action(__('auth.welcome.submit'), URL::signedRoute(
                'auth.welcome',
                ['user' => $notifiable->id]
            ))
            ->line('Thank you for using our application!');
    }
}
