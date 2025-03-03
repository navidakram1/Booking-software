<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with(['customer', 'service'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $customers = Customer::orderBy('name')->get();
        $services = Service::where('is_active', true)->get();

        return view('admin.content.testimonials', compact('testimonials', 'customers', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'service_id' => 'nullable|exists:services,id',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['status'] = 'pending';
        Testimonial::create($validated);

        return redirect()
            ->route('admin.content.testimonials.index')
            ->with('success', 'Testimonial created successfully');
    }

    public function show($id)
    {
        $testimonial = Testimonial::with(['customer', 'service'])->findOrFail($id);
        return response()->json($testimonial);
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'service_id' => 'nullable|exists:services,id',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()
            ->route('admin.content.testimonials.index')
            ->with('success', 'Testimonial updated successfully');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        
        $testimonial->delete();

        return response()->json(['message' => 'Testimonial deleted successfully']);
    }

    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status' => 'approved']);

        return response()->json(['message' => 'Testimonial approved successfully']);
    }
} 