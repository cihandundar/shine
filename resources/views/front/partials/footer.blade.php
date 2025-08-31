<!-- Footer Partial - Bottom information and links area -->
<footer class="bg-gray-800 text-white mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and Description -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <img src="{{ asset('front/assets/images/logo.png') }}" alt="Shine Logo" class="h-8 w-auto">
                    <span class="text-xl font-bold">Shine</span>
                </div>
                <p class="text-gray-300 mb-4">
                    A blog platform filled with quality content and up-to-date information. 
                    Follow us for technology, lifestyle and much more.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Home</a></li>
                    <li><a href="{{ route('about.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">About</a></li>
                    <li><a href="{{ route('archive.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Archive</a></li>
                    <li><a href="{{ route('category.index') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Categories</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact</h3>
                <ul class="space-y-2 text-gray-300">
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-envelope text-blue-400"></i>
                        <span>info@shine.com</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-phone text-blue-400"></i>
                        <span>+90 555 123 45 67</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-map-marker-alt text-blue-400"></i>
                        <span>Istanbul, Turkey</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Line -->
        <div class="border-t border-gray-700 mt-8 pt-8 text-center">
            <p class="text-gray-300">
                &copy; {{ date('Y') }} Shine. All rights reserved.
            </p>
        </div>
    </div>
</footer>
