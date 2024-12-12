<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Affiliate;
use App\Models\PushSubscriber;
use App\Models\PushNotification;
use App\Services\PushNotificationService;

class MarketingController extends Controller
{
    protected $pushService;

    public function __construct(PushNotificationService $pushService)
    {
        $this->pushService = $pushService;
    }

    public function campaigns()
    {
        return view('admin.marketing.campaigns');
    }

    public function promotions()
    {
        return view('admin.marketing.promotions');
    }

    public function email()
    {
        return view('admin.marketing.email');
    }

    public function sms()
    {
        return view('admin.marketing.sms');
    }

    public function push()
    {
        $subscriberCount = PushSubscriber::count();
        $recentNotifications = PushNotification::with('segments')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('admin.marketing.push', compact('subscriberCount', 'recentNotifications'));
    }

    public function sendPushNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'link' => 'nullable|url',
            'segment_ids' => 'nullable|array',
            'segment_ids.*' => 'exists:segments,id',
            'schedule_at' => 'nullable|date|after:now'
        ]);

        if ($request->schedule_at) {
            // Schedule the notification
            PushNotification::create([
                'title' => $request->title,
                'body' => $request->body,
                'link' => $request->link,
                'schedule_at' => $request->schedule_at,
                'status' => 'scheduled'
            ])->segments()->sync($request->segment_ids);

            return redirect()->route('admin.marketing.push')
                ->with('success', 'Push notification scheduled successfully');
        }

        // Send immediately
        $result = $this->pushService->send(
            $request->title,
            $request->body,
            $request->link,
            $request->segment_ids
        );

        return redirect()->route('admin.marketing.push')
            ->with('success', 'Push notification sent successfully to ' . $result['recipient_count'] . ' subscribers');
    }

    public function pushSubscribers()
    {
        $subscribers = PushSubscriber::with('segments')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.marketing.push.subscribers', compact('subscribers'));
    }

    public function affiliates()
    {
        $affiliates = Affiliate::withCount('referrals')
            ->withSum('referrals', 'commission')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('admin.marketing.affiliates', compact('affiliates'));
    }

    public function storeAffiliate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:affiliates,email',
            'website' => 'nullable|url',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'payment_info' => 'required|string'
        ]);

        Affiliate::create($request->all());
        return redirect()->route('admin.marketing.affiliates')
            ->with('success', 'Affiliate created successfully');
    }

    public function updateAffiliate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:affiliates,email,' . $id,
            'website' => 'nullable|url',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'payment_info' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $affiliate = Affiliate::findOrFail($id);
        $affiliate->update($request->all());
        
        return redirect()->route('admin.marketing.affiliates')
            ->with('success', 'Affiliate updated successfully');
    }

    public function destroyAffiliate($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->delete();
        
        return redirect()->route('admin.marketing.affiliates')
            ->with('success', 'Affiliate deleted successfully');
    }
}
