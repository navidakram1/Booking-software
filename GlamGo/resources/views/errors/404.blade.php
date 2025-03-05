@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-xl w-full px-6 py-16">
        <div class="text-center">
            <div class="mb-8">
                <lord-icon
                    src="https://cdn.lordicon.com/tdrtiskw.json"
                    trigger="loop"
                    colors="primary:#ec4899,secondary:#ec4899"
                    style="width:120px;height:120px">
                </lord-icon>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Page Not Found</h1>
            <p class="text-gray-600 mb-8">The page you're looking for doesn't exist or has been moved.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700">
                <lord-icon
                    src="https://cdn.lordicon.com/zmkotitn.json"
                    trigger="hover"
                    colors="primary:#ffffff"
                    style="width:20px;height:20px"
                    class="mr-2">
                </lord-icon>
                Return Home
            </a>
        </div>
    </div>
</div>
@endsection
