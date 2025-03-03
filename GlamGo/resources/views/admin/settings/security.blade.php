@extends('layouts.admin')

@section('title', 'Security Settings')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">Security Settings</h3>
    </div>

    <div class="mt-8">
        <form action="{{ route('admin.settings.security.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Password Requirements -->
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-700 mb-4">Password Requirements</h4>
                
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="require_uppercase" class="form-checkbox" value="1"
                                {{ setting('require_uppercase', true) ? 'checked' : '' }}>
                            <span class="ml-2">Require uppercase letters</span>
                        </label>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="require_numbers" class="form-checkbox" value="1"
                                {{ setting('require_numbers', true) ? 'checked' : '' }}>
                            <span class="ml-2">Require numbers</span>
                        </label>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="require_symbols" class="form-checkbox" value="1"
                                {{ setting('require_symbols', true) ? 'checked' : '' }}>
                            <span class="ml-2">Require special characters</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Minimum Password Length</label>
                        <input type="number" name="min_password_length" class="mt-1 form-input block w-full" 
                            value="{{ setting('min_password_length', 8) }}" min="8" max="32">
                    </div>
                </div>
            </div>

            <!-- Account Security -->
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-700 mb-4">Account Security</h4>
                
                <div class="space-y-4">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="enable_2fa" class="form-checkbox" value="1"
                                {{ setting('enable_2fa', false) ? 'checked' : '' }}>
                            <span class="ml-2">Enable Two-Factor Authentication</span>
                        </label>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="force_password_change" class="form-checkbox" value="1"
                                {{ setting('force_password_change', false) ? 'checked' : '' }}>
                            <span class="ml-2">Force password change every 90 days</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Maximum Login Attempts</label>
                        <input type="number" name="max_login_attempts" class="mt-1 form-input block w-full" 
                            value="{{ setting('max_login_attempts', 5) }}" min="3" max="10">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Account Lockout Duration (minutes)</label>
                        <input type="number" name="lockout_duration" class="mt-1 form-input block w-full" 
                            value="{{ setting('lockout_duration', 30) }}" min="5" max="1440">
                    </div>
                </div>
            </div>

            <!-- Session Security -->
            <div class="bg-white shadow rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-700 mb-4">Session Security</h4>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Session Timeout (minutes)</label>
                        <input type="number" name="session_timeout" class="mt-1 form-input block w-full" 
                            value="{{ setting('session_timeout', 120) }}" min="5" max="1440">
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="force_https" class="form-checkbox" value="1"
                                {{ setting('force_https', true) ? 'checked' : '' }}>
                            <span class="ml-2">Force HTTPS</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-pink-500 text-white rounded-md hover:bg-pink-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 