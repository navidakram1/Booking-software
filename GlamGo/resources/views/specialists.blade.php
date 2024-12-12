@extends('layouts.app')

@section('title', 'Our Specialists - GlamGo')

@section('content')
    <!-- Hero Section -->
    <div class="pt-32 pb-16 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">Meet Our Expert Team</h1>
            <p class="text-gray-600 max-w-2xl mx-auto mb-8">Our talented specialists bring years of experience and passion to every service, ensuring you receive the highest quality care and stunning results.</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('booking') }}" class="px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">Book Appointment</a>
                <a href="#team" class="px-6 py-3 border border-purple-300 text-purple-600 rounded-full hover:bg-purple-50 transition-all duration-300">Meet the Team</a>
            </div>
        </div>
    </div>

    <!-- Department Categories -->
    <div class="py-16 bg-white/80 backdrop-blur-md">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Our Departments</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Hair Styling -->
                <div class="p-6 rounded-2xl bg-white/90 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <lord-icon src="https://cdn.lordicon.com/dqxvvqzi.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Hair Styling</h3>
                    <p class="text-gray-600 text-center">Expert hair stylists specializing in cuts, colors, and treatments.</p>
                </div>
                <!-- Makeup -->
                <div class="p-6 rounded-2xl bg-white/90 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <lord-icon src="https://cdn.lordicon.com/rqsvgwdj.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Makeup Artistry</h3>
                    <p class="text-gray-600 text-center">Professional makeup artists for any occasion.</p>
                </div>
                <!-- Skincare -->
                <div class="p-6 rounded-2xl bg-white/90 shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <lord-icon src="https://cdn.lordicon.com/usjxhgcp.json" trigger="hover" colors="primary:#ec4899,secondary:#9333ea" style="width:32px;height:32px"></lord-icon>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Skincare</h3>
                    <p class="text-gray-600 text-center">Licensed estheticians providing premium skin treatments.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Members -->
    <div id="team" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Our Specialists</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Specialist 1 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl bg-white/90 p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="https://images.pexels.com/photos/2681751/pexels-photo-2681751.jpeg" alt="Sarah Johnson" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-center mb-2">Sarah Johnson</h3>
                        <p class="text-pink-500 text-center mb-4">Senior Hair Stylist</p>
                        <div class="space-y-2 text-gray-600 text-sm">
                            <p>✨ 10+ years of experience</p>
                            <p>🏆 Award-winning colorist</p>
                            <p>📚 Certified in advanced cutting techniques</p>
                        </div>
                        <div class="mt-4 flex justify-center space-x-4">
                            <a href="{{ route('booking.services') }}" class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Specialist 2 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl bg-white/90 p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="https://images.pexels.com/photos/3065015/pexels-photo-3065015.jpeg" alt="Emily Chen" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-center mb-2">Emily Chen</h3>
                        <p class="text-pink-500 text-center mb-4">Makeup Artist</p>
                        <div class="space-y-2 text-gray-600 text-sm">
                            <p>✨ Celebrity makeup artist</p>
                            <p>🏆 Featured in Vogue</p>
                            <p>📚 Specialized in bridal makeup</p>
                        </div>
                        <div class="mt-4 flex justify-center space-x-4">
                            <a href="{{ route('booking.services') }}" class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Specialist 3 -->
                <div class="group">
                    <div class="relative overflow-hidden rounded-2xl bg-white/90 p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-500/20 to-purple-600/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <img src="https://images.pexels.com/photos/3220360/pexels-photo-3220360.jpeg" alt="Maria Rodriguez" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                        <h3 class="text-xl font-semibold text-center mb-2">Maria Rodriguez</h3>
                        <p class="text-pink-500 text-center mb-4">Skincare Specialist</p>
                        <div class="space-y-2 text-gray-600 text-sm">
                            <p>✨ Licensed esthetician</p>
                            <p>🏆 Advanced skin treatment certified</p>
                            <p>📚 Holistic skincare expert</p>
                        </div>
                        <div class="mt-4 flex justify-center space-x-4">
                            <a href="{{ route('booking.services') }}" class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-full hover:shadow-lg transition-all duration-300">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Achievements -->
    <div class="py-16 bg-white/80 backdrop-blur-md">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Why Choose Our Team?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-pink-500 mb-2">15+</div>
                    <p class="text-gray-600">Years of Experience</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-pink-500 mb-2">5000+</div>
                    <p class="text-gray-600">Happy Clients</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-pink-500 mb-2">25+</div>
                    <p class="text-gray-600">Expert Specialists</p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-pink-500 mb-2">100%</div>
                    <p class="text-gray-600">Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection