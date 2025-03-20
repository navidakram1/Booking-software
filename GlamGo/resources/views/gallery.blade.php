@extends('layouts.main')

@section('title', 'Gallery - GlamGo')

@section('content')
    <x-gallery-section :galleryItems="$galleryItems" />

    <!-- Modal Container (Alpine.js) -->
    <div x-data="{ showModal: false }" 
         x-on:keydown.escape.window="showModal = false"
         id="gallery-modal">
    </div>
@endsection
