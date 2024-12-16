@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Add New Staff Member</h1>
            <a href="{{ route('admin.staff.index') }}" class="text-gray-600 hover:text-gray-900">
                Back to Staff List
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Basic Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">First Name</label>
                            <input type="text" name="first_name" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Last Name</label>
                            <input type="text" name="last_name" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Phone</label>
                            <input type="tel" name="phone" class="w-full border rounded px-3 py-2" required>
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Professional Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Position</label>
                            <input type="text" name="position" class="w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Experience (Years)</label>
                            <input type="number" name="experience_years" class="w-full border rounded px-3 py-2" min="0" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Bio</label>
                            <textarea name="bio" rows="4" class="w-full border rounded px-3 py-2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Services & Skills -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Services & Skills</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Services</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                @foreach($services ?? [] as $service)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="services[]" value="{{ $service->id }}">
                                    <span>{{ $service->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Specializations</label>
                            <input type="text" name="specializations" class="w-full border rounded px-3 py-2" 
                                placeholder="e.g., Hair Coloring, Bridal Makeup">
                        </div>
                    </div>
                </div>

                <!-- Schedule -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Work Schedule</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="working_days[]" value="{{ strtolower($day) }}">
                                <span>{{ $day }}</span>
                            </label>
                            <div class="flex space-x-2">
                                <input type="time" name="schedule[{{ strtolower($day) }}][start]" class="border rounded px-2 py-1">
                                <span>to</span>
                                <input type="time" name="schedule[{{ strtolower($day) }}][end]" class="border rounded px-2 py-1">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Profile Image -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-4">Profile Image</h2>
                    <div>
                        <label class="block text-sm font-medium mb-1">Upload Image</label>
                        <input type="file" name="profile_image" accept="image/*" class="w-full">
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="history.back()" class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-100">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark">
                        Add Staff Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
