<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - GlamGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    
    <!-- Include Header -->
    @include('components.header')

    <main class="pt-32 pb-16">
        <!-- Hero Section -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">Beauty Blog</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Stay updated with the latest beauty trends, tips, and transformations</p>
            </div>
        </section>

        <!-- Blog Posts Grid -->
        <section class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="bg-white/90 backdrop-blur-xl rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-white/20 hover:shadow-2xl transition-all duration-300 hover:scale-[1.02]">
                    <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm font-medium">{{ $post['category'] }}</span>
                            <span class="text-gray-500 text-sm">{{ $post['read_time'] }} read</span>
                        </div>
                        <h2 class="text-xl font-semibold mb-2 bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">{{ $post['title'] }}</h2>
                        <p class="text-gray-600 mb-4">{{ $post['excerpt'] }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">By {{ $post['author'] }}</span>
                            </div>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post['date'])->format('M d, Y') }}</span>
                        </div>
                        <a href="{{ url('/blog/' . $post['slug']) }}" 
                           class="mt-4 inline-block w-full py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-xl font-semibold text-center hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform transition-all duration-200">
                            Read More
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </section>
    </main>

    <!-- Include Footer -->
    @include('components.footer')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</body>
</html>
