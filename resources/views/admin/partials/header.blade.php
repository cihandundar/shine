@php
    $user = auth()->user();
@endphp

<!-- Minimal Header - Sadece gerekli bilgiler -->
<header class="w-full bg-white shadow-sm border-b border-gray-200 py-3 px-6">
    <div class="flex justify-between items-center">
        <!-- Page Title -->
        <div class="flex items-center">
            <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Admin Panel')</h1>
        </div>
        
        <!-- Quick Actions -->
        <div class="flex items-center space-x-3">
            <!-- Notifications -->
            <button class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fa-solid fa-bell text-lg"></i>
            </button>
            
            <!-- Logout Button -->
            <a href="{{ route('admin.logout') }}" 
               class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors flex items-center space-x-2">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="hidden sm:inline">Logout</span>
            </a>
        </div>
    </div>
</header>
