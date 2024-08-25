<?php

namespace App\Notifications;

use App\Services\ResendMailMessage;  // Import the custom class
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Log;

class TestResendNotification extends Notification
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
        Log::info('Creating mail message.');
        return (new ResendMailMessage) // Use the custom ResendMailMessage class
                    ->subject('Test Resend Notification')
                    ->line('This is a test notification sent via the Resend API.')
                    ->line('Thank you for using our application!');
    }
}
