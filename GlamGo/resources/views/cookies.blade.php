<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Policy - GlamGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[url('https://images.pexels.com/photos/7130555/pexels-photo-7130555.jpeg?cs=srgb&dl=pexels-codioful-7130555.jpg&fm=jpg')] bg-cover bg-fixed bg-center">
    
    <!-- Include Header -->
    @include('components.header')

    <main class="pt-32 pb-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-8">Cookie Policy</h1>
                
                <div class="space-y-6 text-gray-600">
                    <section>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. What Are Cookies</h2>
                        <p>Cookies are small text files that are placed on your device when you visit our website. They help us provide you with a better experience by:</p>
                        <ul class="list-disc ml-6 mt-2">
                            <li>Remembering your preferences</li>
                            <li>Keeping you signed in</li>
                            <li>Understanding how you use our website</li>
                            <li>Improving our services based on your behavior</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. Types of Cookies We Use</h2>
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-medium text-gray-800">Essential Cookies</h3>
                                <p>Required for the website to function properly. These cannot be disabled.</p>
                            </div>
                            <div>
                                <h3 class="text-xl font-medium text-gray-800">Functional Cookies</h3>
                                <p>Remember your preferences and enhance your experience.</p>
                            </div>
                            <div>
                                <h3 class="text-xl font-medium text-gray-800">Analytics Cookies</h3>
                                <p>Help us understand how visitors interact with our website.</p>
                            </div>
                            <div>
                                <h3 class="text-xl font-medium text-gray-800">Marketing Cookies</h3>
                                <p>Used to deliver relevant advertisements and track their effectiveness.</p>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. Managing Cookies</h2>
                        <p>You can control cookies through your browser settings. However, disabling certain cookies may limit your ability to use some features of our website.</p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Third-Party Cookies</h2>
                        <p>We use third-party services that may set cookies on your device. These include:</p>
                        <ul class="list-disc ml-6 mt-2">
                            <li>Google Analytics for website analytics</li>
                            <li>Payment processors for secure transactions</li>
                            <li>Social media platforms for content sharing</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">5. Updates to This Policy</h2>
                        <p>We may update this Cookie Policy from time to time. Any changes will be posted on this page with an updated revision date.</p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">6. Contact Us</h2>
                        <p>If you have any questions about our Cookie Policy, please contact us at:</p>
                        <p class="mt-2">Email: privacy@glamgo.com</p>
                        <p>Phone: (555) 123-4567</p>
                    </section>
                </div>
            </div>
        </div>
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
