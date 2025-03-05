<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Review;
use App\Models\Staff;
use App\Models\StaffLeave;
use App\Models\Service;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::latest()->paginate(10);
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'services' => 'nullable|array',
            'working_hours' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        Staff::create($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member created successfully.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $staff->id,
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'services' => 'nullable|array',
            'working_hours' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $staff->update($validated);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff member deleted successfully.');
    }

    public function schedule()
    {
        $staff = Staff::all();
        return view('admin.staff.schedule', compact('staff'));
    }

    public function updateSchedule(Request $request)
    {
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'working_hours' => 'required|array'
        ]);

        $staff = Staff::findOrFail($validated['staff_id']);
        $staff->working_hours = $validated['working_hours'];
        $staff->save();

        return redirect()->route('admin.staff.schedule')
            ->with('success', 'Staff schedule updated successfully.');
    }

    public function show($id)
    {
        $staff = Staff::with(['services', 'shifts'])->findOrFail($id);
        return view('admin.staff.show', [
            'staff' => $staff,
            'performanceMetrics' => $this->getStaffPerformanceMetrics($id)
        ]);
    }

    public function leaveRequests()
    {
        $leaveRequests = StaffLeave::with('staff')->orderBy('created_at', 'desc')->get();
        return view('admin.staff.leave.index', compact('leaveRequests'));
    }

    public function storeLeave(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
            'type' => 'required|in:vacation,sick,personal'
        ]);

        StaffLeave::create($request->all());
        return redirect()->route('admin.staff.leave')->with('success', 'Leave request submitted successfully');
    }

    public function updateLeave(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
            'type' => 'required|in:vacation,sick,personal'
        ]);

        $leave = StaffLeave::findOrFail($id);
        $leave->update($request->all());
        return redirect()->route('admin.staff.leave')->with('success', 'Leave request updated successfully');
    }

    public function destroyLeave($id)
    {
        $leave = StaffLeave::findOrFail($id);
        $leave->delete();
        return redirect()->route('admin.staff.leave')->with('success', 'Leave request deleted successfully');
    }

    public function approveLeave($id)
    {
        $leave = StaffLeave::findOrFail($id);
        $leave->update(['status' => 'approved']);
        return redirect()->route('admin.staff.leave')->with('success', 'Leave request approved successfully');
    }

    public function rejectLeave($id)
    {
        $leave = StaffLeave::findOrFail($id);
        $leave->update(['status' => 'rejected']);
        return redirect()->route('admin.staff.leave')->with('success', 'Leave request rejected successfully');
    }

    public function list()
    {
        $query = Staff::query()
            ->withCount('appointments')
            ->with(['services', 'appointments' => function($query) {
                $query->select('id', 'staff_id', 'rating');
            }]);

        // Apply search filter
        if (request()->has('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Apply role filter
        if (request()->has('role') && request('role') !== '') {
            $query->where('role', request('role'));
        }

        // Apply status filter
        if (request()->has('status') && request('status') !== '') {
            $query->where('is_active', request('status') === 'active');
        }

        // Get statistics
        $totalStaff = Staff::count();
        $totalAppointments = Appointment::count();
        $totalServices = Service::count();
        $averageRating = Appointment::whereNotNull('rating')->avg('rating') ?? 0;

        $staff = $query->latest()->paginate(10);

        // Calculate average rating for each staff member
        $staff->each(function($member) {
            $member->rating = $member->appointments->whereNotNull('rating')->avg('rating') ?? 0;
        });

        return view('admin.staff.list', compact(
            'staff',
            'totalStaff',
            'totalAppointments',
            'totalServices',
            'averageRating'
        ));
    }

    protected function getPerformanceMetrics()
    {
        // Get overall performance metrics for all staff
        return [
            'totalAppointments' => Appointment::count(),
            'averageRating' => Review::avg('rating'),
            'topPerformers' => Staff::withCount('appointments')
                ->orderBy('appointments_count', 'desc')
                ->take(5)
                ->get()
        ];
    }

    protected function getStaffPerformanceMetrics($id)
    {
        $staff = Staff::findOrFail($id);
        return [
            'appointments' => $staff->appointments()->count(),
            'rating' => $staff->reviews()->avg('rating'),
            'revenue' => $staff->appointments()->sum('total_amount'),
            'clientRetention' => $this->calculateClientRetention($id)
        ];
    }

    protected function calculateClientRetention($staffId)
    {
        // Calculate the percentage of clients who have booked more than once
        $totalClients = Appointment::where('staff_id', $staffId)
            ->distinct('client_id')
            ->count();
            
        $returningClients = Appointment::where('staff_id', $staffId)
            ->groupBy('client_id')
            ->havingRaw('COUNT(*) > 1')
            ->count();

        return $totalClients > 0 ? ($returningClients / $totalClients) * 100 : 0;
    }
}
