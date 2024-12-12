<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Event;
use App\Models\LandingPage;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ContentController extends Controller
{
    public function testimonials()
    {
        $testimonials = Testimonial::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.content.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'service_id' => 'nullable|exists:services,id',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('testimonials', 'public');
            $data['image'] = $path;
        }

        Testimonial::create($data);

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial added successfully');
    }

    public function updateTestimonial(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'service_id' => 'nullable|exists:services,id',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            
            $path = $request->file('image')->store('testimonials', 'public');
            $data['image'] = $path;
        }

        $testimonial->update($data);

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial updated successfully');
    }

    public function destroyTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        // Delete image if exists
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        
        $testimonial->delete();

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial deleted successfully');
    }

    public function approveTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['status' => 'approved']);

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial approved successfully');
    }

    public function team()
    {
        $team = TeamMember::orderBy('display_order')
            ->with('services')
            ->paginate(10);
            
        return view('admin.content.team', compact('team'));
    }

    public function storeTeamMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'required|image|max:2048',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url'
        ]);

        $data = $request->except(['image', 'services']);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
            $data['image'] = $path;
        }

        // Set display order to be last
        $data['display_order'] = TeamMember::max('display_order') + 1;

        $teamMember = TeamMember::create($data);

        if ($request->has('services')) {
            $teamMember->services()->sync($request->services);
        }

        return redirect()->route('admin.content.team')
            ->with('success', 'Team member added successfully');
    }

    public function updateTeamMember(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'status' => 'required|in:active,inactive'
        ]);

        $teamMember = TeamMember::findOrFail($id);
        $data = $request->except(['image', 'services']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }
            
            $path = $request->file('image')->store('team', 'public');
            $data['image'] = $path;
        }

        $teamMember->update($data);

        if ($request->has('services')) {
            $teamMember->services()->sync($request->services);
        }

        return redirect()->route('admin.content.team')
            ->with('success', 'Team member updated successfully');
    }

    public function destroyTeamMember($id)
    {
        $teamMember = TeamMember::findOrFail($id);
        
        // Delete image if exists
        if ($teamMember->image) {
            Storage::disk('public')->delete($teamMember->image);
        }
        
        $teamMember->delete();

        // Reorder remaining team members
        TeamMember::where('display_order', '>', $teamMember->display_order)
            ->decrement('display_order');

        return redirect()->route('admin.content.team')
            ->with('success', 'Team member deleted successfully');
    }

    public function reorderTeam(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:team_members,id'
        ]);

        foreach ($request->order as $index => $id) {
            TeamMember::where('id', $id)->update(['display_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function events()
    {
        $events = Event::with(['services', 'teamMembers'])
            ->orderBy('start_date', 'desc')
            ->paginate(10);
            
        return view('admin.content.events', compact('events'));
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image' => 'required|image|max:2048',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'team_members' => 'nullable|array',
            'team_members.*' => 'exists:team_members,id'
        ]);

        $data = $request->except(['image', 'services', 'team_members']);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $data['image'] = $path;
        }

        $event = Event::create($data);

        if ($request->has('services')) {
            $event->services()->sync($request->services);
        }

        if ($request->has('team_members')) {
            $event->teamMembers()->sync($request->team_members);
        }

        return redirect()->route('admin.content.events')
            ->with('success', 'Event created successfully');
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'team_members' => 'nullable|array',
            'team_members.*' => 'exists:team_members,id',
            'status' => 'required|in:draft,published,cancelled'
        ]);

        $event = Event::findOrFail($id);
        $data = $request->except(['image', 'services', 'team_members']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            
            $path = $request->file('image')->store('events', 'public');
            $data['image'] = $path;
        }

        $event->update($data);

        if ($request->has('services')) {
            $event->services()->sync($request->services);
        }

        if ($request->has('team_members')) {
            $event->teamMembers()->sync($request->team_members);
        }

        return redirect()->route('admin.content.events')
            ->with('success', 'Event updated successfully');
    }

    public function destroyEvent($id)
    {
        $event = Event::findOrFail($id);
        
        // Delete image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();

        return redirect()->route('admin.content.events')
            ->with('success', 'Event deleted successfully');
    }

    public function publishEvent($id)
    {
        $event = Event::findOrFail($id);
        
        if ($event->start_date < Carbon::now()) {
            return redirect()->route('admin.content.events')
                ->with('error', 'Cannot publish past events');
        }
        
        $event->update(['status' => 'published']);

        return redirect()->route('admin.content.events')
            ->with('success', 'Event published successfully');
    }

    public function landing()
    {
        $landingPage = LandingPage::first();
        $galleryImages = GalleryImage::orderBy('display_order')->get();
        
        return view('admin.content.landing', compact('landingPage', 'galleryImages'));
    }

    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_cta_text' => 'required|string|max:50',
            'hero_cta_link' => 'required|string|max:255',
            'hero_image' => 'nullable|image|max:2048',
            'hero_video' => 'nullable|mimetypes:video/mp4|max:20480'
        ]);

        $landingPage = LandingPage::first();
        $data = $request->except(['hero_image', 'hero_video']);

        if ($request->hasFile('hero_image')) {
            if ($landingPage->hero_image) {
                Storage::disk('public')->delete($landingPage->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('landing/hero', 'public');
        }

        if ($request->hasFile('hero_video')) {
            if ($landingPage->hero_video) {
                Storage::disk('public')->delete($landingPage->hero_video);
            }
            $data['hero_video'] = $request->file('hero_video')->store('landing/hero', 'public');
        }

        $landingPage->update($data);

        return redirect()->route('admin.content.landing')
            ->with('success', 'Hero section updated successfully');
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'about_title' => 'required|string|max:255',
            'about_content' => 'required|string',
            'about_image' => 'nullable|image|max:2048',
            'about_video' => 'nullable|mimetypes:video/mp4|max:20480'
        ]);

        $landingPage = LandingPage::first();
        $data = $request->except(['about_image', 'about_video']);

        if ($request->hasFile('about_image')) {
            if ($landingPage->about_image) {
                Storage::disk('public')->delete($landingPage->about_image);
            }
            $data['about_image'] = $request->file('about_image')->store('landing/about', 'public');
        }

        if ($request->hasFile('about_video')) {
            if ($landingPage->about_video) {
                Storage::disk('public')->delete($landingPage->about_video);
            }
            $data['about_video'] = $request->file('about_video')->store('landing/about', 'public');
        }

        $landingPage->update($data);

        return redirect()->route('admin.content.landing')
            ->with('success', 'About section updated successfully');
    }

    public function updateFeatures(Request $request)
    {
        $request->validate([
            'features' => 'required|array|min:1',
            'features.*.title' => 'required|string|max:255',
            'features.*.description' => 'required|string',
            'features.*.icon' => 'required|string|max:50'
        ]);

        $landingPage = LandingPage::first();
        $landingPage->update([
            'features' => $request->features
        ]);

        return redirect()->route('admin.content.landing')
            ->with('success', 'Features section updated successfully');
    }

    public function updateStats(Request $request)
    {
        $request->validate([
            'stats' => 'required|array|min:1',
            'stats.*.label' => 'required|string|max:255',
            'stats.*.value' => 'required|integer|min:0',
            'stats.*.icon' => 'required|string|max:50'
        ]);

        $landingPage = LandingPage::first();
        $landingPage->update([
            'stats' => $request->stats
        ]);

        return redirect()->route('admin.content.landing')
            ->with('success', 'Stats section updated successfully');
    }

    public function addGalleryImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255'
        ]);

        $path = $request->file('image')->store('landing/gallery', 'public');
        
        GalleryImage::create([
            'image' => $path,
            'caption' => $request->caption,
            'display_order' => GalleryImage::max('display_order') + 1
        ]);

        return redirect()->route('admin.content.landing')
            ->with('success', 'Gallery image added successfully');
    }

    public function removeGalleryImage($id)
    {
        $image = GalleryImage::findOrFail($id);
        
        Storage::disk('public')->delete($image->image);
        $image->delete();

        // Reorder remaining images
        GalleryImage::where('display_order', '>', $image->display_order)
            ->decrement('display_order');

        return redirect()->route('admin.content.landing')
            ->with('success', 'Gallery image removed successfully');
    }

    public function reorderGallery(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'exists:gallery_images,id'
        ]);

        foreach ($request->order as $index => $id) {
            GalleryImage::where('id', $id)->update(['display_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
