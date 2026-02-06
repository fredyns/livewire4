<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IT Services - Digital Solutions for Your Business</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white dark:bg-zinc-900 text-gray-900 dark:text-gray-100 font-sans antialiased">
<!-- Navigation -->
<nav class="fixed top-0 w-full bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md z-50 border-b border-gray-200 dark:border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">IT Services</span>
            </div>
            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                            Log in
                        </a>
                        @if(!app()->isProduction())
                            <a href="{{ route('login-as') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                Log in as
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                                Get Started
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
            Digital Solutions for Your Business
        </h1>
        <p class="text-xl sm:text-2xl text-gray-600 dark:text-gray-400 mb-12 max-w-3xl mx-auto">
            Transform your business with cutting-edge IT services, cloud solutions, and expert consulting
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#services" class="px-8 py-4 text-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors shadow-lg hover:shadow-xl">
                Explore Services
            </a>
            <a href="#contact" class="px-8 py-4 text-lg font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-zinc-800 hover:bg-gray-200 dark:hover:bg-zinc-700 rounded-lg transition-colors">
                Contact Us
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-20 bg-gray-50 dark:bg-zinc-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Our Services</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Comprehensive IT solutions tailored to your needs</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="bg-white dark:bg-zinc-900 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-200 dark:border-zinc-800">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Cloud Solutions</h3>
                <p class="text-gray-600 dark:text-gray-400">Scalable cloud infrastructure and migration services to modernize your operations</p>
            </div>

            <!-- Service 2 -->
            <div class="bg-white dark:bg-zinc-900 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-200 dark:border-zinc-800">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Cybersecurity</h3>
                <p class="text-gray-600 dark:text-gray-400">Protect your business with advanced security solutions and threat monitoring</p>
            </div>

            <!-- Service 3 -->
            <div class="bg-white dark:bg-zinc-900 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-200 dark:border-zinc-800">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Software Development</h3>
                <p class="text-gray-600 dark:text-gray-400">Custom software solutions built with modern technologies and best practices</p>
            </div>

            <!-- Service 4 -->
            <div class="bg-white dark:bg-zinc-900 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-200 dark:border-zinc-800">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">IT Consulting</h3>
                <p class="text-gray-600 dark:text-gray-400">Strategic technology consulting to optimize your IT infrastructure</p>
            </div>

            <!-- Service 5 -->
            <div class="bg-white dark:bg-zinc-900 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-200 dark:border-zinc-800">
                <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Data Management</h3>
                <p class="text-gray-600 dark:text-gray-400">Efficient data storage, backup, and recovery solutions for business continuity</p>
            </div>

            <!-- Service 6 -->
            <div class="bg-white dark:bg-zinc-900 p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-200 dark:border-zinc-800">
                <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">24/7 Support</h3>
                <p class="text-gray-600 dark:text-gray-400">Round-the-clock technical support to keep your business running smoothly</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Why Choose Us</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Industry-leading expertise and commitment to excellence</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl font-bold text-blue-600 mb-2">15+</div>
                <p class="text-gray-600 dark:text-gray-400">Years Experience</p>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-purple-600 mb-2">500+</div>
                <p class="text-gray-600 dark:text-gray-400">Projects Completed</p>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-green-600 mb-2">98%</div>
                <p class="text-gray-600 dark:text-gray-400">Client Satisfaction</p>
            </div>
            <div class="text-center">
                <div class="text-4xl font-bold text-orange-600 mb-2">24/7</div>
                <p class="text-gray-600 dark:text-gray-400">Support Available</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gradient-to-br from-blue-600 to-purple-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">Ready to Transform Your Business?</h2>
        <p class="text-xl text-blue-100 mb-8">Let's discuss how our IT services can help you achieve your goals</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-8 py-4 text-lg font-semibold text-blue-600 bg-white hover:bg-gray-100 rounded-lg transition-colors shadow-lg">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-8 py-4 text-lg font-semibold text-blue-600 bg-white hover:bg-gray-100 rounded-lg transition-colors shadow-lg">
                    Get Started Today
                </a>
            @endauth
            <a href="mailto:info@itservices.com" class="px-8 py-4 text-lg font-semibold text-white bg-transparent border-2 border-white hover:bg-white hover:text-blue-600 rounded-lg transition-colors">
                Contact Sales
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 dark:bg-black text-gray-400 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h3 class="text-white font-semibold mb-4">IT Services</h3>
                <p class="text-sm">Delivering excellence in technology solutions since 2009</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors">Cloud Solutions</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Cybersecurity</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Development</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Consulting</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 pt-8 text-center text-sm">
            <p>&copy; {{ date('Y') }} IT Services. All rights reserved. Built with Laravel & Livewire.</p>
        </div>
    </div>
</footer>
</body>
</html>
