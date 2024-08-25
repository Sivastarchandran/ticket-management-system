<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;

class ResendEmailNotification extends Notification
{
    use Queueable;

    private $recipient;
    private $subject;
    private $message;

    public function __construct($recipient, $subject, $message)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Build the email payload
        $payload = [
            'from' => 'sivastarchandran@gmail.com',
            'to' => $this->recipient,
            'subject' => $this->subject,
            'html' => $this->message,
        ];

        // Send email via resend.com API
        $client = new Client();
        $response = $client->post('https://api.resend.com/v1/emails', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('RESEND_API_KEY'),
                'Content-Type'  => 'application/json',
            ],
            'body' => json_encode($payload),
        ]);

        if ($response->getStatusCode() == 200) {
            return $this->message;
        }

        return 'Failed to send email';
    }
}
