<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class AdminPasswordResetNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = URL::temporarySignedRoute(
            'admin.password.reset',
            Carbon::now()->addMinutes(Config::get('auth.passwords.admins.expire', 60)),
            [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]
        );

        return (new MailMessage)
            ->subject('Admin Password Reset Notification')
            ->line('You are receiving this email because we received a password reset request for your admin account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire in ' . Config::get('auth.passwords.admins.expire', 60) . ' minutes.')
            ->line('If you did not request a password reset, no further action is required.');
    }
} 