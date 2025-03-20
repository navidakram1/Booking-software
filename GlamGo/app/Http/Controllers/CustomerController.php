<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomerPreference;
use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Activity;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->withCount(['bookings', 'loyaltyPoints'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other'
        ]);

        $customer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'role' => 'customer'
        ]);

        return redirect()->route('admin.customers.show', $customer->id)
            ->with('success', 'Customer created successfully');
    }

    public function show($id)
    {
        $customer = User::where('role', 'customer')
            ->with(['bookings', 'loyaltyPoints', 'preferences'])
            ->findOrFail($id);
            
        return view('admin.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other'
        ]);

        $customer = User::where('role', 'customer')->findOrFail($id);
        
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender
        ]);

        if ($request->filled('password')) {
            $customer->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.customers.show', $customer->id)
            ->with('success', 'Customer updated successfully');
    }

    public function destroy($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully');
    }

    public function preferences($id)
    {
        $customer = User::where('role', 'customer')
            ->with('preferences')
            ->findOrFail($id);
            
        return view('admin.customers.preferences', compact('customer'));
    }

    public function preferencesUpdate(Request $request, $id)
    {
        $request->validate([
            'preferences' => 'required|array',
            'preferences.*.type' => 'required|string|max:50',
            'preferences.*.value' => 'required|string|max:255'
        ]);

        $customer = User::where('role', 'customer')->findOrFail($id);
        
        // Delete existing preferences
        $customer->preferences()->delete();
        
        // Create new preferences
        foreach ($request->preferences as $preference) {
            $customer->preferences()->create([
                'type' => $preference['type'],
                'value' => $preference['value']
            ]);
        }

        return redirect()->back()->with('success', 'Customer preferences updated successfully');
    }

    public function loyalty($id)
    {
        $customer = User::where('role', 'customer')
            ->with(['loyaltyPoints' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->findOrFail($id);
            
        return view('admin.customers.loyalty', compact('customer'));
    }

    public function addLoyaltyPoints(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:1',
            'reason' => 'required|string|max:255'
        ]);

        $customer = User::where('role', 'customer')->findOrFail($id);
        
        $customer->loyaltyPoints()->create([
            'points' => $request->points,
            'type' => 'earned',
            'reason' => $request->reason
        ]);

        return redirect()->back()->with('success', 'Loyalty points added successfully');
    }

    public function redeemLoyaltyPoints(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:1',
            'reason' => 'required|string|max:255'
        ]);

        $customer = User::where('role', 'customer')->findOrFail($id);
        
        $totalPoints = $customer->loyaltyPoints()
            ->where('type', 'earned')
            ->sum('points');
            
        $redeemedPoints = $customer->loyaltyPoints()
            ->where('type', 'redeemed')
            ->sum('points');
            
        $availablePoints = $totalPoints - $redeemedPoints;
        
        if ($request->points > $availablePoints) {
            return redirect()->back()
                ->with('error', 'Customer does not have enough points to redeem');
        }

        $customer->loyaltyPoints()->create([
            'points' => $request->points,
            'type' => 'redeemed',
            'reason' => $request->reason
        ]);

        return redirect()->back()->with('success', 'Loyalty points redeemed successfully');
    }

    public function dashboard()
    {
        $user = auth()->user();

        // Get upcoming bookings
        $upcomingBookings = $user->bookings()
            ->with(['service'])
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')
            ->take(5)
            ->get();

        // Get total bookings count
        $totalBookings = $user->bookings()->count();

        // Get loyalty points
        $loyaltyPoints = $user->loyaltyPoints()->sum('points');

        // Get recent activity
        $recentActivity = Activity::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Get favorite services
        $favoriteServices = $user->favorites()
            ->with(['category'])
            ->take(4)
            ->get();

        return view('customer.dashboard', compact(
            'upcomingBookings',
            'totalBookings',
            'loyaltyPoints',
            'recentActivity',
            'favoriteServices'
        ));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('customer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB max
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = basename($path);
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function bookings()
    {
        $user = auth()->user();
        $bookings = $user->bookings()
            ->with(['service', 'staff'])
            ->latest()
            ->paginate(10);

        return view('customer.bookings', compact('bookings'));
    }

    public function reviews()
    {
        $user = auth()->user();
        $reviews = $user->reviews()
            ->with(['service', 'booking'])
            ->latest()
            ->paginate(10);

        return view('customer.reviews', compact('reviews'));
    }

    public function favorites()
    {
        $user = auth()->user();
        $favorites = $user->favorites()
            ->with(['category'])
            ->paginate(12);

        return view('customer.favorites', compact('favorites'));
    }

    public function toggleFavorite(Service $service)
    {
        $user = auth()->user();
        $user->favorites()->toggle($service);

        return response()->json([
            'success' => true,
            'isFavorite' => $user->favorites()->where('service_id', $service->id)->exists()
        ]);
    }
}
