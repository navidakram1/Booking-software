<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamGo - Modern Salon Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="bg-gradient-to-br from-pink-50 to-purple-50 min-h-screen">
    <!-- Navigation Header -->
    <header class="fixed w-full top-0 z-50">
        <nav class="nav-blur mx-auto max-w-5xl mt-3 sm:mt-4 md:mt-6 px-4 sm:px-6 py-2 rounded-full transition-all duration-300">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <div class="flex items-center space-x-1.5 sm:space-x-2">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs sm:text-sm font-bold">G</span>
                        </div>
                        <span class="text-base sm:text-lg font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent">GlamGo</span>
                    </div>
                </div>

                <!-- Navigation Links - Hidden on Mobile -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="#" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/wmwqvixz.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:24px;height:24px">
                        </lord-icon>
                        <span>Home</span>
                    </a>
                    <a href="#services" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/wmlleaaf.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:24px;height:24px">
                        </lord-icon>
                        <span>Services</span>
                    </a>
                    <a href="#specialists" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/ktsahwvc.json"
                            trigger="loop"
                            state="loop-jab"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:24px;height:24px">
                        </lord-icon>
                        <span>Specialists</span>
                    </a>
                    <a href="#about" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/jnzhohhs.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:24px;height:24px">
                        </lord-icon>
                        <span>About</span>
                    </a>
                    <a href="#contact" class="flex items-center space-x-1 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-lg font-bold hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/diihvcfp.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:24px;height:24px">
                        </lord-icon>
                        <span>Contact</span>
                    </a>
                </div>

                <!-- Right Side Navigation -->
                <div class="flex items-center space-x-1.5 sm:space-x-2">
                    <!-- Book Now Button -->
                    <button class="hidden md:flex px-3 lg:px-4 py-1.5 bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs lg:text-sm rounded-full shadow-md hover:shadow-lg transition-all duration-300 items-center justify-center group">
                        <span class="mr-2">Book Now</span>
                        <lord-icon
                            src="https://cdn.lordicon.com/whtfgdfm.json"
                            trigger="hover"
                            colors="primary:#ffffff"
                            style="width:18px;height:18px">
                        </lord-icon>
                    </button>

                    <!-- Login Button -->
                    <div class="relative login-button">
                        <button class="p-2 rounded-full hover:bg-pink-50/50 transition-all duration-300 group">
                            <lord-icon
                                src="https://cdn.lordicon.com/hrjifpbq.json"
                                trigger="hover"
                                colors="primary:#ec4899,secondary:#9333ea"
                                style="width:24px;height:24px">
                            </lord-icon>
                        </button>
                        <div class="login-dropdown hidden absolute top-full right-0 mt-2 py-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 backdrop-blur-sm">
                            <a href="#login" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50/50 transition-all duration-300">Login</a>
                            <a href="#register" class="block px-4 py-2 text-sm text-gray-700 hover:bg-pink-50/50 transition-all duration-300">Register</a>
                        </div>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-full hover:bg-pink-50/50 transition-all duration-300">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Items - Hidden by Default -->
            <div id="mobile-menu" class="md:hidden mt-4 hidden opacity-0 transition-all duration-300 transform -translate-y-2">
                <div class="flex flex-col space-y-2 bg-white/90 backdrop-blur-sm rounded-2xl p-3 border border-gray-100 shadow-lg">
                    <a href="#" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-sm hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/wmwqvixz.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span>Home</span>
                    </a>
                    <a href="#services" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-sm hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/wmlleaaf.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span>Services</span>
                    </a>
                    <a href="#specialists" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-sm hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/ktsahwvc.json"
                            trigger="loop"
                            state="loop-jab"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span>Specialists</span>
                    </a>
                    <a href="#about" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-sm hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/jnzhohhs.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span>About</span>
                    </a>
                    <a href="#contact" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-sm hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/diihvcfp.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span>Contact</span>
                    </a>
                    <div class="w-full h-px bg-gray-100 my-1"></div>
                    <a href="#login" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900 px-3 py-2 rounded-xl text-sm hover:bg-pink-50/50 transition-all duration-300">
                        <lord-icon
                            src="https://cdn.lordicon.com/hrjifpbq.json"
                            trigger="hover"
                            colors="primary:#ec4899,secondary:#9333ea"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span>Login / Register</span>
                    </a>
                    <button class="w-full mt-2 px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-600 text-white text-sm rounded-xl shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center group">
                        <span class="mr-2">Book Now</span>
                        <lord-icon
                            src="https://cdn.lordicon.com/whtfgdfm.json"
                            trigger="hover"
                            colors="primary:#ffffff"
                            style="width:18px;height:18px">
                        </lord-icon>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <style>
        .nav-blur {
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        
        .nav-scrolled {
            background: linear-gradient(to right, rgba(236, 72, 153, 0.1), rgba(147, 51, 234, 0.1));
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 
                0 4px 6px -1px rgba(0, 0, 0, 0.1), 
                0 2px 4px -1px rgba(0, 0, 0, 0.06),
                inset 0 0 20px rgba(236, 72, 153, 0.05);
        }
        
        .nav-scrolled:hover {
            box-shadow: 
                0 10px 15px -3px rgba(0, 0, 0, 0.1), 
                0 4px 6px -2px rgba(0, 0, 0, 0.05),
                inset 0 0 20px rgba(236, 72, 153, 0.08);
            transform: translateY(-1px);
        }

        .nav-scrolled .text-gray-600 {
            background: linear-gradient(to right, #ec4899, #9333ea);
            -webkit-background-clip: text;
            color: transparent;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .nav-scrolled .text-gray-600:hover {
            opacity: 1;
        }

        .nav-scrolled .text-gray-600 svg {
            stroke: #ec4899;
            transition: all 0.3s ease;
        }

        .nav-scrolled .text-gray-600:hover svg {
            stroke: #9333ea;
            filter: drop-shadow(0 0 2px rgba(236, 72, 153, 0.3));
            transform: scale(1.05);
        }
        
        .nav-blur {
            background: rgba(255, 255, 255, 0.01);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .login-dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }

        .login-button:hover .login-dropdown,
        .login-dropdown:hover {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .login-button:hover .login-dropdown {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Modern Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 12px;
            background: transparent;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.4), rgba(139, 92, 246, 0.4));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, rgba(236, 72, 153, 0.6), rgba(139, 92, 246, 0.6));
        }

        /* Firefox scrollbar */
        * {
            scrollbar-width: thin;
            scrollbar-color: rgba(236, 72, 153, 0.4) rgba(255, 255, 255, 0.1);
        }

        /* Glass effect for containers */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
        }

        .words-wrapper {
            display: inline-flex;
            position: relative;
            text-align: center;
            height: 1.6em;
            vertical-align: middle;
            width: auto;
            min-width: 140px;
            padding: 0.1em 0;
            margin: 0.2em 0;
            overflow: visible;
        }

        @media (min-width: 768px) {
            .words-wrapper {
                min-width: 200px;
                height: 1.5em;
            }
        }

        @media (min-width: 1024px) {
            .words-wrapper {
                min-width: 280px;
                height: 1.4em;
            }
        }

        .words-wrapper .word {
            position: absolute;
            width: 100%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            animation: none;
            white-space: nowrap;
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.3));
            line-height: 1.1;
            padding: 0.1em 0;
            display: block;
        }

        .words-wrapper .word:nth-child(1) { animation: word-animation-1 12s infinite; }
        .words-wrapper .word:nth-child(2) { animation: word-animation-2 12s infinite; }
        .words-wrapper .word:nth-child(3) { animation: word-animation-3 12s infinite; }

        .headline-container {
            min-height: 2.2em;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5em 0;
            position: relative;
        }

        @keyframes word-animation-1 {
            0%, 27% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
                filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.5));
            }
            32% {
                opacity: 0;
                transform: translate(-50%, calc(-50% - 20px)) scale(0.9);
                filter: drop-shadow(0 0 0px rgba(236, 72, 153, 0));
            }
            90%, 100% {
                opacity: 0;
                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
            }
        }

        @keyframes word-animation-2 {
            0%, 32% {
                opacity: 0;
                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
            }
            37%, 60% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
                filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.5));
            }
            65% {
                opacity: 0;
                transform: translate(-50%, calc(-50% - 20px)) scale(0.9);
                filter: drop-shadow(0 0 0px rgba(139, 92, 246, 0));
            }
            100% {
                opacity: 0;
                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
            }
        }

        @keyframes word-animation-3 {
            0%, 65% {
                opacity: 0;
                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
            }
            70%, 93% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
                filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.5));
            }
            97%, 100% {
                opacity: 0;
                transform: translate(-50%, calc(-50% - 20px)) scale(0.9);
                filter: drop-shadow(0 0 0px rgba(236, 72, 153, 0));
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            let isOpen = false;

            menuButton.addEventListener('click', function() {
                isOpen = !isOpen;
                if (isOpen) {
                    mobileMenu.classList.remove('hidden');
                    setTimeout(() => {
                        mobileMenu.classList.remove('opacity-0', '-translate-y-2');
                    }, 10);
                } else {
                    mobileMenu.classList.add('opacity-0', '-translate-y-2');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300);
                }
            });
        });
    </script>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.nav-blur');
            if (window.scrollY > 50) {
                header.classList.add('nav-scrolled');
            } else {
                header.classList.remove('nav-scrolled');
            }
        });
    </script>

    <!-- Main Content with Padding for Fixed Header -->
    <main class="pt-24">
        <!-- Hero Section with Services and Booking -->
        <section class="pt-20 pb-8 px-8 min-h-screen bg-gradient-to-b from-transparent via-white/5 to-white/10">
            <div class="container mx-auto">
                <!-- Title -->
                <div class="text-center mb-12">
                    <style>
                        /* Modern Scrollbar Styling */
                        ::-webkit-scrollbar {
                            width: 12px;
                            background: transparent;
                        }

                        ::-webkit-scrollbar-track {
                            background: rgba(255, 255, 255, 0.1);
                            backdrop-filter: blur(10px);
                            -webkit-backdrop-filter: blur(10px);
                            border-radius: 10px;
                            border: 1px solid rgba(255, 255, 255, 0.1);
                        }

                        ::-webkit-scrollbar-thumb {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.4), rgba(139, 92, 246, 0.4));
                            backdrop-filter: blur(10px);
                            -webkit-backdrop-filter: blur(10px);
                            border-radius: 10px;
                            border: 1px solid rgba(255, 255, 255, 0.2);
                            transition: all 0.3s ease;
                        }

                        ::-webkit-scrollbar-thumb:hover {
                            background: linear-gradient(135deg, rgba(236, 72, 153, 0.6), rgba(139, 92, 246, 0.6));
                        }

                        /* Firefox scrollbar */
                        * {
                            scrollbar-width: thin;
                            scrollbar-color: rgba(236, 72, 153, 0.4) rgba(255, 255, 255, 0.1);
                        }

                        /* Glass effect for containers */
                        .glass-effect {
                            background: rgba(255, 255, 255, 0.1);
                            backdrop-filter: blur(10px);
                            -webkit-backdrop-filter: blur(10px);
                            border: 1px solid rgba(255, 255, 255, 0.2);
                            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
                        }

                        .words-wrapper {
                            display: inline-flex;
                            position: relative;
                            text-align: center;
                            height: 1.6em;
                            vertical-align: middle;
                            width: auto;
                            min-width: 140px;
                            padding: 0.1em 0;
                            margin: 0.2em 0;
                            overflow: visible;
                        }

                        @media (min-width: 768px) {
                            .words-wrapper {
                                min-width: 200px;
                                height: 1.5em;
                            }
                        }

                        @media (min-width: 1024px) {
                            .words-wrapper {
                                min-width: 280px;
                                height: 1.4em;
                            }
                        }

                        .words-wrapper .word {
                            position: absolute;
                            width: 100%;
                            left: 50%;
                            top: 50%;
                            transform: translate(-50%, -50%);
                            opacity: 0;
                            animation: none;
                            white-space: nowrap;
                            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
                            -webkit-background-clip: text;
                            background-clip: text;
                            -webkit-text-fill-color: transparent;
                            filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.3));
                            line-height: 1.1;
                            padding: 0.1em 0;
                            display: block;
                        }

                        .words-wrapper .word:nth-child(1) { animation: word-animation-1 12s infinite; }
                        .words-wrapper .word:nth-child(2) { animation: word-animation-2 12s infinite; }
                        .words-wrapper .word:nth-child(3) { animation: word-animation-3 12s infinite; }

                        .headline-container {
                            min-height: 2.2em;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            padding: 0.5em 0;
                            position: relative;
                        }

                        @keyframes word-animation-1 {
                            0%, 27% {
                                opacity: 1;
                                transform: translate(-50%, -50%) scale(1);
                                filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.5));
                            }
                            32% {
                                opacity: 0;
                                transform: translate(-50%, calc(-50% - 20px)) scale(0.9);
                                filter: drop-shadow(0 0 0px rgba(236, 72, 153, 0));
                            }
                            90%, 100% {
                                opacity: 0;
                                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
                            }
                        }

                        @keyframes word-animation-2 {
                            0%, 32% {
                                opacity: 0;
                                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
                            }
                            37%, 60% {
                                opacity: 1;
                                transform: translate(-50%, -50%) scale(1);
                                filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.5));
                            }
                            65% {
                                opacity: 0;
                                transform: translate(-50%, calc(-50% - 20px)) scale(0.9);
                                filter: drop-shadow(0 0 0px rgba(139, 92, 246, 0));
                            }
                            100% {
                                opacity: 0;
                                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
                            }
                        }

                        @keyframes word-animation-3 {
                            0%, 65% {
                                opacity: 0;
                                transform: translate(-50%, calc(-50% + 20px)) scale(0.9);
                            }
                            70%, 93% {
                                opacity: 1;
                                transform: translate(-50%, -50%) scale(1);
                                filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.5));
                            }
                            97%, 100% {
                                opacity: 0;
                                transform: translate(-50%, calc(-50% - 20px)) scale(0.9);
                                filter: drop-shadow(0 0 0px rgba(236, 72, 153, 0));
                            }
                        }
                    </style>
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <div class="headline-container">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold relative">
                                <div class="flex flex-wrap justify-center items-center gap-x-2 md:gap-x-3">
                                    <span class="bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Feel</span>
                                    <span class="words-wrapper">
                                        <span class="word">Beautiful</span>
                                        <span class="word">Amazing</span>
                                        <span class="word">Special</span>
                                    </span>
                                    <span class="bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">With Us</span>
                                </div>
                            </h1>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-2xl mx-auto px-4 text-center">
                            Your perfect look is just one appointment away
                        </p>
                    </div>
                </div>

                <!-- Services and Booking Grid -->
                <div class="bg-white/90 backdrop-blur-md shadow-xl rounded-xl p-8 hover:shadow-2xl transition-all duration-300 border border-white/50">
                    <div class="flex flex-col lg:flex-row gap-8">
                        <!-- Services Selection -->
                        <div class="lg:w-1/2">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Our Services</h2>
                            
                            <!-- Service Categories -->
                            <div class="flex flex-wrap gap-4 mb-8">
                                <button class="px-4 py-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white text-sm">All Services</button>
                                <button class="px-4 py-2 rounded-full bg-white text-gray-600 hover:bg-pink-50/50 text-sm transition-all duration-300">Hair</button>
                                <button class="px-4 py-2 rounded-full bg-white text-gray-600 hover:bg-pink-50/50 text-sm transition-all duration-300">Spa</button>
                                <button class="px-4 py-2 rounded-full bg-white text-gray-600 hover:bg-pink-50/50 text-sm transition-all duration-300">Nails</button>
                                <button class="px-4 py-2 rounded-full bg-white text-gray-600 hover:bg-pink-50/50 text-sm transition-all duration-300">Makeup</button>
                            </div>

                            <!-- Services Carousel -->
                            <div class="swiper services-swiper">
                                <div class="swiper-wrapper">
                                    <!-- Service Card 1 -->
                                    <div class="swiper-slide">
                                        <label class="relative group cursor-pointer">
                                            <input type="radio" name="service" class="hidden peer" checked>
                                            <div class="relative overflow-hidden rounded-2xl aspect-[4/3]">
                                                <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df" 
                                                    alt="Luxury Spa Treatment" 
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <h3 class="font-semibold text-lg mb-1">Luxury Spa Treatment</h3>
                                                    <div class="flex items-center mt-1 text-sm text-gray-500">
                                                        <span class="text-sm opacity-90">60 min</span>
                                                        <span class="mx-2">•</span>
                                                        <span class="font-medium">$89</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Service Card 2 -->
                                    <div class="swiper-slide">
                                        <label class="relative group cursor-pointer">
                                            <input type="radio" name="service" class="hidden peer">
                                            <div class="relative overflow-hidden rounded-2xl aspect-[4/3]">
                                                <img src="https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1" 
                                                    alt="Hair Styling" 
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <h3 class="font-semibold text-lg mb-1">Hair Styling</h3>
                                                    <div class="flex items-center mt-1 text-sm text-gray-500">
                                                        <span class="text-sm opacity-90">45 min</span>
                                                        <span class="mx-2">•</span>
                                                        <span class="font-medium">$59</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Service Card 3 -->
                                    <div class="swiper-slide">
                                        <label class="relative group cursor-pointer">
                                            <input type="radio" name="service" class="hidden peer">
                                            <div class="relative overflow-hidden rounded-2xl aspect-[4/3]">
                                                <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881" 
                                                    alt="Facial Treatment" 
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <h3 class="font-semibold text-lg mb-1">Facial Treatment</h3>
                                                    <div class="flex items-center mt-1 text-sm text-gray-500">
                                                        <span class="text-sm opacity-90">75 min</span>
                                                        <span class="mx-2">•</span>
                                                        <span class="font-medium">$79</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Service Card 4 -->
                                    <div class="swiper-slide">
                                        <label class="relative group cursor-pointer">
                                            <input type="radio" name="service" class="hidden peer">
                                            <div class="relative overflow-hidden rounded-2xl aspect-[4/3]">
                                                <img src="https://images.unsplash.com/photo-1519014816548-bf5fe059798b" 
                                                    alt="Nail Art" 
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <h3 class="font-semibold text-lg mb-1">Nail Art & Care</h3>
                                                    <div class="flex items-center mt-1 text-sm text-gray-500">
                                                        <span class="text-sm opacity-90">60 min</span>
                                                        <span class="mx-2">•</span>
                                                        <span class="font-medium">$49</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Service Card 5 -->
                                    <div class="swiper-slide">
                                        <label class="relative group cursor-pointer">
                                            <input type="radio" name="service" class="hidden peer">
                                            <div class="relative overflow-hidden rounded-2xl aspect-[4/3]">
                                                <img src="https://images.unsplash.com/photo-1487412947147-5cebf100ffc2" 
                                                    alt="Makeup" 
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <h3 class="font-semibold text-lg mb-1">Professional Makeup</h3>
                                                    <div class="flex items-center mt-1 text-sm text-gray-500">
                                                        <span class="text-sm opacity-90">90 min</span>
                                                        <span class="mx-2">•</span>
                                                        <span class="font-medium">$99</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Service Card 6 -->
                                    <div class="swiper-slide">
                                        <label class="relative group cursor-pointer">
                                            <input type="radio" name="service" class="hidden peer">
                                            <div class="relative overflow-hidden rounded-2xl aspect-[4/3]">
                                                <img src="https://images.unsplash.com/photo-1540555700478-dfd03ed5d881" 
                                                    alt="Massage" 
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <h3 class="font-semibold text-lg mb-1">Relaxing Massage</h3>
                                                    <div class="flex items-center mt-1 text-sm text-gray-500">
                                                        <span class="text-sm opacity-90">90 min</span>
                                                        <span class="mx-2">•</span>
                                                        <span class="font-medium">$109</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <!-- Navigation -->
                                <div class="swiper-button-next after:content-[''] group right-2">
                                    <span class="bg-white rounded-full p-3 shadow-md flex items-center justify-center group-hover:bg-pink-50 transition-all duration-300">
                                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="swiper-button-prev after:content-[''] group left-2">
                                    <span class="bg-white rounded-full p-3 shadow-md flex items-center justify-center group-hover:bg-pink-50 transition-all duration-300">
                                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </span>
                                </div>
                                <!-- Pagination -->
                                <div class="swiper-pagination !bottom-0 !-mb-6"></div>
                            </div>

                            <style>
                                .swiper-pagination-bullet {
                                    width: 8px;
                                    height: 8px;
                                    background: #e2e8f0;
                                    opacity: 1;
                                }
                                .swiper-pagination-bullet-active {
                                    background: #ec4899;
                                    width: 24px;
                                    border-radius: 4px;
                                    transition: width 0.3s ease;
                                }
                                .swiper-button-next,
                                .swiper-button-prev {
                                    width: 40px;
                                    height: 40px;
                                    margin-top: -20px;
                                }
                                @media (max-width: 640px) {
                                    .swiper-button-next,
                                    .swiper-button-prev {
                                        display: none;
                                    }
                                }
                            </style>

                            <!-- Specialist Selection -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Choose Your Specialist</h3>
                                <div class="specialist-selection-container">
                                    <!-- Specialist Card 1 -->
                                    <div class="specialist-card">
                                        <div class="specialist-image-container">
                                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" alt="Sarah Johnson" class="specialist-image">
                                        </div>
                                        <div class="specialist-info">
                                            <h4 class="specialist-name">Sarah Johnson</h4>
                                            <span class="specialist-tag">Hair Stylist</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Specialist Card 2 -->
                                    <div class="specialist-card">
                                        <div class="specialist-image-container">
                                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80" alt="Emily Davis" class="specialist-image">
                                        </div>
                                        <div class="specialist-info">
                                            <h4 class="specialist-name">Emily Davis</h4>
                                            <span class="specialist-tag">Makeup Artist</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Specialist Card 3 -->
                                    <div class="specialist-card">
                                        <div class="specialist-image-container">
                                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e" alt="Michael Chen" class="specialist-image">
                                        </div>
                                        <div class="specialist-info">
                                            <h4 class="specialist-name">Michael Chen</h4>
                                            <span class="specialist-tag">Massage Therapist</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Specialist Card 4 -->
                                    <div class="specialist-card">
                                        <div class="specialist-image-container">
                                            <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e" alt="Lisa Anderson" class="specialist-image">
                                        </div>
                                        <div class="specialist-info">
                                            <h4 class="specialist-name">Lisa Anderson</h4>
                                            <span class="specialist-tag">Nail Artist</span>
                                        </div>
                                    </div>
                                </div>

                                <style>
                                    .specialist-selection-container {
                                        display: flex;
                                        overflow-x: auto;
                                        gap: 24px;
                                        padding: 20px;
                                        background-color: rgba(247, 233, 240, 0.5);
                                        border-radius: 16px;
                                        scrollbar-width: none;
                                        -ms-overflow-style: none;
                                    }

                                    .specialist-selection-container::-webkit-scrollbar {
                                        display: none;
                                    }

                                    .specialist-card {
                                        flex: 0 0 auto;
                                        width: 140px;
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        gap: 12px;
                                        transition: transform 0.3s ease;
                                        cursor: pointer;
                                        padding: 8px;
                                    }

                                    .specialist-card:hover {
                                        transform: translateY(-8px);
                                    }

                                    .specialist-image-container {
                                        width: 120px;
                                        height: 120px;
                                        border-radius: 50%;
                                        overflow: hidden;
                                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                                        border: 4px solid white;
                                        transition: transform 0.3s ease;
                                    }

                                    .specialist-card:hover .specialist-image-container {
                                        transform: scale(1.05);
                                    }

                                    .specialist-image {
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                    }

                                    .specialist-info {
                                        text-align: center;
                                        width: 100%;
                                    }

                                    .specialist-name {
                                        font-family: 'Poppins', sans-serif;
                                        font-size: 0.9rem;
                                        font-weight: 600;
                                        color: #333;
                                        margin-bottom: 4px;
                                        white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                    }

                                    .specialist-tag {
                                        font-family: 'Poppins', sans-serif;
                                        font-size: 0.75rem;
                                        font-weight: 400;
                                        color: #ec4899;
                                        background: rgba(236, 72, 153, 0.1);
                                        padding: 4px 8px;
                                        border-radius: 12px;
                                        display: inline-block;
                                        white-space: nowrap;
                                    }

                                    @media (max-width: 640px) {
                                        .specialist-selection-container {
                                            padding: 16px;
                                            gap: 16px;
                                        }

                                        .specialist-card {
                                            width: 120px;
                                        }

                                        .specialist-image-container {
                                            width: 100px;
                                            height: 100px;
                                        }
                                    }
                                </style>
                            </div>

                        </div>

                        <!-- Vertical Divider -->
                        <div class="hidden lg:block w-px bg-gray-200"></div>

                        <!-- Right Side - Booking Form -->
                        <div class="lg:w-1/2 p-6 bg-white rounded-2xl shadow-sm">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-gray-800">Book Your Appointment</h2>
                                <!-- Home Service Toggle -->
                                <div class="flex items-center bg-gradient-to-br from-gray-100 to-gray-200 p-2 rounded-full shadow-[0_4px_12px_rgba(0,0,0,0.15)] border-2 border-white">
                                    <div class="relative flex items-center">
                                        <label for="homeServiceToggle" class="flex items-center space-x-3 px-6 py-3 rounded-full cursor-pointer transition-all duration-300" id="inStoreLabel">
                                            <svg class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            <span class="font-semibold text-base">In Store</span>
                                        </label>
                                        <label for="homeServiceToggle" class="flex items-center space-x-3 px-6 py-3 rounded-full cursor-pointer transition-all duration-300" id="homeServiceLabel">
                                            <svg class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                            </svg>
                                            <span class="font-semibold text-base">Home Service</span>
                                        </label>
                                        <input type="checkbox" id="homeServiceToggle" class="sr-only" onchange="toggleHomeService()">
                                        <div class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-br from-pink-500 to-purple-600 shadow-[0_4px_16px_rgba(236,72,153,0.3)] rounded-full transition-all duration-300 transform" id="toggleBackground"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Progress Steps -->
                            <div class="flex justify-between items-center mb-8">
                                <div class="flex items-center w-full">
                                    <div class="relative flex flex-col items-center flex-1">
                                        <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center text-white font-bold step-active">1</div>
                                        <div class="text-xs mt-1">Service</div>
                                    </div>
                                    <div class="flex-1 h-px bg-gray-300 step-line"></div>
                                    <div class="relative flex flex-col items-center flex-1">
                                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold step-inactive">2</div>
                                        <div class="text-xs mt-1">Date & Time</div>
                                    </div>
                                    <div class="flex-1 h-px bg-gray-300 step-line"></div>
                                    <div class="relative flex flex-col items-center flex-1">
                                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold step-inactive">3</div>
                                        <div class="text-xs mt-1">Details</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 1: Service Selection -->
                            <div id="step1" class="form-step active">
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                    <!-- Service Card 1 -->
                                    <div class="service-card group">
                                        <input type="radio" name="service" id="service1" class="hidden peer" checked>
                                        <label for="service1" class="block p-4 bg-white rounded-xl border-2 border-transparent hover:border-pink-500 cursor-pointer transition-all duration-300 peer-checked:border-pink-500 peer-checked:shadow-lg">
                                            <div class="relative aspect-[4/3] rounded-lg overflow-hidden mb-3">
                                                <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df" alt="Hair Styling" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                                <div class="absolute bottom-2 right-2 w-8 h-8 rounded-full bg-pink-500 text-white flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity duration-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="font-semibold text-gray-800 mb-1">Hair Styling</h3>
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-600">45 mins</span>
                                                <span class="font-medium text-pink-500">$50</span>
                                            </div>
                                            <p class="service-location text-sm text-gray-500 mt-2 hidden">In store</p>
                                        </label>
                                    </div>

                                    <!-- Service Card 2 -->
                                    <div class="service-card group">
                                        <input type="radio" name="service" id="service2" class="hidden peer">
                                        <label for="service2" class="block p-4 bg-white rounded-xl border-2 border-transparent hover:border-pink-500 cursor-pointer transition-all duration-300 peer-checked:border-pink-500 peer-checked:shadow-lg">
                                            <div class="relative aspect-[4/3] rounded-lg overflow-hidden mb-3">
                                                <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035" alt="Makeup" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                                <div class="absolute bottom-2 right-2 w-8 h-8 rounded-full bg-pink-500 text-white flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity duration-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="font-semibold text-gray-800 mb-1">Makeup</h3>
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-600">60 mins</span>
                                                <span class="font-medium text-pink-500">$75</span>
                                            </div>
                                            <p class="service-location text-sm text-gray-500 mt-2 hidden">In store</p>
                                        </label>
                                    </div>

                                    <!-- Service Card 3 -->
                                    <div class="service-card group">
                                        <input type="radio" name="service" id="service3" class="hidden peer">
                                        <label for="service3" class="block p-4 bg-white rounded-xl border-2 border-transparent hover:border-pink-500 cursor-pointer transition-all duration-300 peer-checked:border-pink-500 peer-checked:shadow-lg">
                                            <div class="relative aspect-[4/3] rounded-lg overflow-hidden mb-3">
                                                <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e" alt="Spa" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                                <div class="absolute bottom-2 right-2 w-8 h-8 rounded-full bg-pink-500 text-white flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity duration-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <h3 class="font-semibold text-gray-800 mb-1">Spa Treatment</h3>
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="text-gray-600">90 mins</span>
                                                <span class="font-medium text-pink-500">$120</span>
                                            </div>
                                            <p class="service-location text-sm text-gray-500 mt-2 hidden">In store</p>
                                        </label>
                                    </div>
                                </div>
                                <button onclick="nextStep(1)" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300">Continue</button>
                            </div>

                            <!-- Step 2: Date & Time -->
                            <div id="step2" class="form-step hidden">
                                <div class="space-y-6 mb-6">
                                    <!-- Date Selection -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2" for="date">Select Date</label>
                                        <div class="grid grid-cols-4 sm:grid-cols-7 gap-2">
                                            <button class="date-btn" data-date="2024-01-20">
                                                <span class="block text-xs text-gray-500">SAT</span>
                                                <span class="block text-lg font-semibold">20</span>
                                            </button>
                                            <button class="date-btn active" data-date="2024-01-21">
                                                <span class="block text-xs text-gray-500">SUN</span>
                                                <span class="block text-lg font-semibold">21</span>
                                            </button>
                                            <button class="date-btn" data-date="2024-01-22">
                                                <span class="block text-xs text-gray-500">MON</span>
                                                <span class="block text-lg font-semibold">22</span>
                                            </button>
                                            <button class="date-btn" data-date="2024-01-23">
                                                <span class="block text-xs text-gray-500">TUE</span>
                                                <span class="block text-lg font-semibold">23</span>
                                            </button>
                                            <button class="date-btn" data-date="2024-01-24">
                                                <span class="block text-xs text-gray-500">WED</span>
                                                <span class="block text-lg font-semibold">24</span>
                                            </button>
                                            <button class="date-btn" data-date="2024-01-25">
                                                <span class="block text-xs text-gray-500">THU</span>
                                                <span class="block text-lg font-semibold">25</span>
                                            </button>
                                            <button class="date-btn" data-date="2024-01-26">
                                                <span class="block text-xs text-gray-500">FRI</span>
                                                <span class="block text-lg font-semibold">26</span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Time Selection -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2" for="time">Select Time</label>
                                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                            <button class="time-btn" data-time="09:00">9:00 AM</button>
                                            <button class="time-btn active" data-time="10:00">10:00 AM</button>
                                            <button class="time-btn" data-time="11:00">11:00 AM</button>
                                            <button class="time-btn" data-time="12:00">12:00 PM</button>
                                            <button class="time-btn" data-time="13:00">1:00 PM</button>
                                            <button class="time-btn" data-time="14:00">2:00 PM</button>
                                            <button class="time-btn" data-time="15:00">3:00 PM</button>
                                            <button class="time-btn" data-time="16:00">4:00 PM</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-3">
                                    <button onclick="prevStep(2)" class="w-1/2 bg-gray-100 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-200 transition-all duration-300">Back</button>
                                    <button onclick="nextStep(2)" class="w-1/2 bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300">Continue</button>
                                </div>
                            </div>

                            <!-- Step 3: Personal Details -->
                            <div id="step3" class="form-step hidden">
                                <div class="space-y-4 mb-4">
                                    <input type="text" placeholder="Full Name" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200">
                                    <input type="email" placeholder="Email Address" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200">
                                    <input type="tel" placeholder="Phone Number" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200">
                                    <textarea placeholder="Special Requests (Optional)" rows="3" class="w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 focus:border-pink-500 focus:ring-2 focus:ring-pink-200"></textarea>
                                </div>
                                <div class="flex space-x-3">
                                    <button onclick="prevStep(3)" class="w-1/2 bg-gray-100 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-200 transition-all duration-300">Back</button>
                                    <button onclick="submitForm()" class="w-1/2 bg-gradient-to-r from-pink-500 to-pink-600 text-white py-3 rounded-xl font-medium hover:shadow-lg transition-all duration-300">Book & Pay</button>
                                </div>
                            </div>

                            <!-- Cancellation Policy -->
                            <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <h4 class="font-medium text-gray-800 mb-2">Cancellation Policy</h4>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex items-start space-x-2">
                                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Free cancellation up to 24 hours before appointment</span>
                                    </li>
                                    <li class="flex items-start space-x-2">
                                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>50% charge for cancellations within 24 hours</span>
                                    </li>
                                    <li class="flex items-start space-x-2">
                                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Full charge for no-shows</span>
                                    </li>
                                </ul>
                            </div>

                            <style>
                                .form-step {
                                    opacity: 0;
                                    transform: translateY(10px);
                                    transition: all 0.3s ease-in-out;
                                }
                                .form-step.active {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                                .step-active {
                                    background: linear-gradient(to right, #ec4899, #9333ea);
                                }
                                .step-completed {
                                    background: #10b981;
                                }
                                .step-line.completed {
                                    background: #10b981;
                                }
                            </style>

                            <script>
                                function nextStep(currentStep) {
                                    // Hide current step
                                    document.getElementById('step' + currentStep).classList.remove('active');
                                    document.getElementById('step' + currentStep).classList.add('hidden');
                                    
                                    // Show next step
                                    const nextStep = currentStep + 1;
                                    document.getElementById('step' + nextStep).classList.remove('hidden');
                                    setTimeout(() => {
                                        document.getElementById('step' + nextStep).classList.add('active');
                                    }, 50);

                                    // Update progress indicators
                                    updateProgress(nextStep);
                                }

                                function prevStep(currentStep) {
                                    // Hide current step
                                    document.getElementById('step' + currentStep).classList.remove('active');
                                    document.getElementById('step' + currentStep).classList.add('hidden');
                                    
                                    // Show previous step
                                    const prevStep = currentStep - 1;
                                    document.getElementById('step' + prevStep).classList.remove('hidden');
                                    setTimeout(() => {
                                        document.getElementById('step' + prevStep).classList.add('active');
                                    }, 50);

                                    // Update progress indicators
                                    updateProgress(prevStep);
                                }

                                function updateProgress(currentStep) {
                                    const steps = document.querySelectorAll('.step-inactive');
                                    const lines = document.querySelectorAll('.step-line');
                                    
                                    steps.forEach((step, index) => {
                                        if (index < currentStep - 1) {
                                            step.classList.add('step-completed');
                                            step.innerHTML = '✓';
                                        }
                                    });
                                    
                                    lines.forEach((line, index) => {
                                        if (index < currentStep - 1) {
                                            line.classList.add('completed');
                                        }
                                    });
                                }

                                function submitForm() {
                                    // Add your form submission logic here
                                    alert('Booking submitted successfully!');
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-16 px-8 bg-gradient-to-t from-transparent via-white/5 to-white/10">
            <div class="container mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">What Our Clients Say</h2>
                    <p class="text-gray-600 mt-2">Read about experiences from our satisfied customers</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-8 hover:shadow-xl transition-all duration-300 group border border-white/50">
                        <p class="text-gray-600 italic mb-4 group-hover:text-gray-800 transition-all duration-300">"The best salon experience I've ever had! The staff was professional and the service was exceptional."</p>
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330" 
                                 class="w-12 h-12 rounded-full object-cover" alt="Sarah">
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Sarah Johnson</h4>
                                <p class="text-sm text-gray-500">Regular Client</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-8 hover:shadow-xl transition-all duration-300 group border border-white/50">
                        <p class="text-gray-600 italic mb-4 group-hover:text-gray-800 transition-all duration-300">"Their massage therapy is amazing! I feel refreshed and energized after every session."</p>
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" 
                                 class="w-12 h-12 rounded-full object-cover" alt="Michael">
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Michael Chen</h4>
                                <p class="text-sm text-gray-500">Wellness Enthusiast</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-white/90 backdrop-blur-md shadow-lg rounded-xl p-8 hover:shadow-xl transition-all duration-300 group border border-white/50">
                        <p class="text-gray-600 italic mb-4 group-hover:text-gray-800 transition-all duration-300">"The facial treatment was incredible. My skin has never looked better!"</p>
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80" 
                                 class="w-12 h-12 rounded-full object-cover" alt="Emma">
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Emma Davis</h4>
                                <p class="text-sm text-gray-500">Beauty Enthusiast</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu functionality
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                setTimeout(() => {
                    mobileMenu.classList.toggle('opacity-0');
                    mobileMenu.classList.toggle('-translate-y-2');
                }, 50);
            });

            // Initialize Swiper
            const swiper = new Swiper('.services-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    }
                }
            });
        });
    </script>

    <style>
        /* Toggle Styles */
        #inStoreLabel, #homeServiceLabel {
            z-index: 1;
            color: #6B7280;
            position: relative;
        }
        #inStoreLabel.active, #homeServiceLabel.active {
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        #toggleBackground {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 
                0 4px 16px rgba(236, 72, 153, 0.3),
                0 2px 8px rgba(0, 0, 0, 0.1),
                inset 0 2px 4px rgba(255, 255, 255, 0.2);
        }
        #homeServiceToggle:checked ~ #toggleBackground {
            transform: translateX(100%);
        }
        
        /* Hover Effects */
        #inStoreLabel:hover svg, #homeServiceLabel:hover svg {
            transform: scale(1.1);
        }
        #inStoreLabel:hover, #homeServiceLabel:hover {
            color: #374151;
        }
        #inStoreLabel.active:hover, #homeServiceLabel.active:hover {
            color: white;
        }
        
        /* Active Label Animation */
        #inStoreLabel.active svg, #homeServiceLabel.active svg {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }
        
        /* Form Animation */
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        #salonForm, #homeServiceForm {
            animation: slideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Service Type Selection
            const serviceTypeRadios = document.querySelectorAll('input[name="service_type"]');
            const homeServiceAddress = document.getElementById('homeServiceAddress');

            serviceTypeRadios.forEach(radio => {
                radio.addEventListener('click', function() {
                    // Remove active class from all buttons
                    serviceTypeRadios.forEach(r => r.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Show/hide address form based on service type
                    if (this.value === 'home') {
                        homeServiceAddress.classList.remove('hidden');
                    } else {
                        homeServiceAddress.classList.add('hidden');
                    }
                });
            });
        });
    </script>

    <style>
        .service-type-btn {
            @apply text-gray-600 hover:text-pink-600;
        }
        .service-type-btn.active {
            @apply bg-white text-pink-600 shadow-md;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inStoreBtn = document.getElementById('inStoreBtn');
            const homeBtn = document.getElementById('homeBtn');
            const homeServiceAddress = document.getElementById('homeServiceAddress');
            const inStoreInfo = document.getElementById('inStoreInfo');
            const homeServiceInfo = document.getElementById('homeServiceInfo');
            const homeServiceForm = document.getElementById('homeServiceForm');

            function switchServiceType(type) {
                // Update button states
                if (type === 'home') {
                    homeBtn.classList.add('active');
                    inStoreBtn.classList.remove('active');
                    // Show home service sections
                    homeServiceAddress.classList.remove('hidden');
                    homeServiceInfo.classList.remove('hidden');
                    inStoreInfo.classList.add('hidden');
                    // Enable form validation
                    enableHomeServiceValidation();
                } else {
                    inStoreBtn.classList.add('active');
                    homeBtn.classList.remove('active');
                    // Show in-store sections
                    homeServiceAddress.classList.add('hidden');
                    homeServiceInfo.classList.add('hidden');
                    inStoreInfo.classList.remove('hidden');
                    // Disable form validation
                    disableHomeServiceValidation();
                }
            }

            inStoreBtn.addEventListener('click', () => switchServiceType('in-store'));
            homeBtn.addEventListener('click', () => switchServiceType('home'));

            function enableHomeServiceValidation() {
                const requiredFields = homeServiceForm.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    field.setAttribute('required', '');
                });
            }

            function disableHomeServiceValidation() {
                const requiredFields = homeServiceForm.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    field.removeAttribute('required');
                    field.value = ''; // Clear the fields when switching to in-store
                });
            }

            // Initialize with in-store service
            switchServiceType('in-store');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceTypeRadios = document.querySelectorAll('input[name="service_type"]');
            const serviceLocationTexts = document.querySelectorAll('.service-location');

            function updateServiceLocation(isInStore) {
                serviceLocationTexts.forEach(text => {
                    if (isInStore) {
                        text.classList.remove('hidden');
                    } else {
                        text.classList.add('hidden');
                    }
                });
            }

            // Add change event listeners to service type radios
            serviceTypeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const isInStore = this.value === 'in_store';
                    updateServiceLocation(isInStore);
                });
            });

            // Check initial state
            const initialServiceType = document.querySelector('input[name="service_type"]:checked');
            if (initialServiceType) {
                updateServiceLocation(initialServiceType.value === 'in_store');
            }
        });
    </script>
</body>
</html>