<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Affiliate;
use App\Models\Promotion;
use App\Models\Customer;
use App\Models\Appointment;
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

    public function emailCreate()
    {
        return view('admin.marketing.email.create');
    }

    public function emailStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'recipients' => 'required|in:all,new,inactive',
            'schedule' => 'required|in:now,later',
            'scheduled_at' => 'required_if:schedule,later|nullable|date|after:now',
        ]);

        // TODO: Implement email campaign creation logic

        return redirect()->route('admin.marketing.email.index')
            ->with('success', 'Email campaign created successfully');
    }

    public function sms()
    {
        return view('admin.marketing.sms');
    }

    public function smsCreate()
    {
        return view('admin.marketing.sms.create');
    }

    public function smsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:160',
            'recipients' => 'required|in:all,new,inactive',
            'schedule' => 'required|in:now,later',
            'scheduled_at' => 'required_if:schedule,later|nullable|date|after:now',
        ]);

        // TODO: Implement SMS campaign creation logic

        return redirect()->route('admin.marketing.sms.index')
            ->with('success', 'SMS campaign created successfully');
    }

    public function promotionsCreate()
    {
        return view('admin.marketing.promotions.create');
    }

    public function promotionsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:service,package,seasonal,referral',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'validity' => 'required|in:limited,ongoing',
            'start_date' => 'required|date',
            'end_date' => 'required_if:validity,limited|nullable|date|after:start_date',
            'limit_per_customer' => 'boolean',
            'uses_per_customer' => 'required_if:limit_per_customer,true|nullable|integer|min:1',
            'limit_total' => 'boolean',
            'total_uses' => 'required_if:limit_total,true|nullable|integer|min:1',
        ]);

        // TODO: Implement promotion creation logic

        return redirect()->route('admin.marketing.promotions.index')
            ->with('success', 'Promotion created successfully');
    }

    public function promotionsIndex()
    {
        $activePromotions = Promotion::where('end_date', '>', now())
            ->orWhere('validity', 'ongoing')
            ->with(['redemptions.customer'])
            ->get()
            ->map(function ($promotion) {
                return [
                    'id' => $promotion->id,
                    'name' => $promotion->name,
                    'type' => $promotion->type,
                    'discount_value' => $promotion->discount_value,
                    'discount_type' => $promotion->discount_type,
                    'redemptions' => $promotion->redemptions->map(function ($redemption) {
                        return [
                            'customer_name' => optional($redemption->customer)->name ?? 'Unknown Customer',
                            'date' => $redemption->created_at->format('Y-m-d H:i:s')
                        ];
                    })
                ];
            });

        return view('admin.marketing.promotions.index', compact('activePromotions'));
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
