<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Service Selection - GlamGo</title>
</head>

<body class="bg-gradient-to-b from-pink-300 via-purple-300 to-gray-200 min-h-screen font-sans">
    <!-- Service Selection Section -->
    <section class="mt-10 mx-auto max-w-6xl px-6">
        <div class="bg-gradient-to-br from-pink-100 to-purple-100 shadow-lg rounded-2xl p-8">
            <!-- Title -->
            <h1 class="text-3xl font-bold text-gray-800">Salon and Massage Services</h1>
            <p class="text-gray-500 text-sm mt-2">Experience our premium beauty and wellness services</p>

            <!-- Filter Section -->
            <div class="flex space-x-4 items-center mt-6">
                <input type="text" placeholder="Search services..." 
                       class="flex-1 bg-white px-4 py-2 rounded-full shadow text-gray-700 text-sm focus:outline-none">
                <div class="flex -space-x-2">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" alt="Stylist Sarah" class="w-9 h-9 rounded-full border-2 border-white shadow">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80" alt="Stylist Emma" class="w-9 h-9 rounded-full border-2 border-white shadow">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb" alt="Stylist Olivia" class="w-9 h-9 rounded-full border-2 border-white shadow">
                </div>
            </div>

            <!-- Service Filters -->
            <div class="flex flex-wrap gap-3 mt-6">
                <span class="bg-gray-200 px-4 py-2 rounded-full text-sm font-medium text-gray-700">Body Care</span>
                <span class="bg-gray-200 px-4 py-2 rounded-full text-sm font-medium text-gray-700">Premium Services</span>
                <span class="bg-gray-200 px-4 py-2 rounded-full text-sm font-medium text-gray-700">Beauty Salon</span>
                <span class="bg-gray-200 px-4 py-2 rounded-full text-sm font-medium text-gray-700">Relaxation</span>
            </div>

            <!-- Service List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                <!-- Service Card 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035" alt="Luxury Spa Treatment" class="w-full h-28 object-cover">
                    <div class="p-4 text-center">
                        <h2 class="text-lg font-medium text-gray-800">Luxury Spa Treatment</h2>
                        <p class="text-sm text-gray-500 mt-1">#relaxation</p>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1516975080664-ed2fc6a32937" alt="Hair Styling" class="w-full h-28 object-cover">
                    <div class="p-4 text-center">
                        <h2 class="text-lg font-medium text-gray-800">Hair Styling</h2>
                        <p class="text-sm text-gray-500 mt-1">#beauty</p>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702" alt="Facial Treatment" class="w-full h-28 object-cover">
                    <div class="p-4 text-center">
                        <h2 class="text-lg font-medium text-gray-800">Facial Treatment</h2>
                        <p class="text-sm text-gray-500 mt-1">#skincare</p>
                    </div>
                </div>

                <!-- Service Card 4 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35" alt="Massage Therapy" class="w-full h-28 object-cover">
                    <div class="p-4 text-center">
                        <h2 class="text-lg font-medium text-gray-800">Massage Therapy</h2>
                        <p class="text-sm text-gray-500 mt-1">#wellness</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
