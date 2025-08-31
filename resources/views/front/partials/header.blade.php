<!-- Header Partial - Top menu and logo area -->
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo Area -->
            <div class="flex items-center">
                <a href="{{ route('home.index') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('front/assets/images/logo.png') }}" alt="Shine Logo" class="h-8 w-auto">
                    <span class="text-xl font-bold text-gray-800">Shine</span>
                </a>
            </div>

            <!-- Main Navigation Menu -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    Home
                </a>
                <a href="{{ route('about.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    About
                </a>
                <a href="{{ route('archive.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    Archive
                </a>
                <a href="{{ route('category.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    Categories
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu (Hidden) -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-4">
                <a href="{{ route('home.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    Home
                </a>
                <a href="{{ route('about.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    About
                </a>
                <a href="{{ route('archive.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    Archive
                </a>
                <a href="{{ route('category.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">
                    Categories
                </a>
            </div>
        </div>
    </div>
</header>
