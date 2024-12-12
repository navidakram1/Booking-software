<?php

namespace App\Services;

use App\Models\PushSubscriber;
use App\Models\PushNotification;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushNotificationService
{
    protected $webPush;

    public function __construct()
    {
        $this->webPush = new WebPush([
            'VAPID' => [
                'subject' => config('app.url'),
                'publicKey' => config('services.webpush.public_key'),
                'privateKey' => config('services.webpush.private_key'),
            ],
        ]);
    }

    public function send($title, $body, $link = null, $segmentIds = null)
    {
        $query = PushSubscriber::query();
        
        if ($segmentIds) {
            $query->whereHas('segments', function ($q) use ($segmentIds) {
                $q->whereIn('segments.id', $segmentIds);
            });
        }

        $subscribers = $query->get();
        $recipientCount = 0;

        foreach ($subscribers as $subscriber) {
            $subscription = Subscription::create([
                'endpoint' => $subscriber->endpoint,
                'keys' => [
                    'p256dh' => $subscriber->public_key,
                    'auth' => $subscriber->auth_token,
                ],
            ]);

            $payload = json_encode([
                'title' => $title,
                'body' => $body,
                'link' => $link,
            ]);

            $this->webPush->sendNotification($subscription, $payload);
            $recipientCount++;
        }

        // Send all notifications
        $this->webPush->flush();

        // Create notification record
        $notification = PushNotification::create([
            'title' => $title,
            'body' => $body,
            'link' => $link,
            'sent_at' => now(),
            'status' => 'sent',
            'recipient_count' => $recipientCount
        ]);

        if ($segmentIds) {
            $notification->segments()->sync($segmentIds);
        }

        return [
            'success' => true,
            'recipient_count' => $recipientCount
        ];
    }
}
