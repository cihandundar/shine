@php
    $user = auth()->user();
    $isSuperAdmin = $user && $user->role && $user->role->name === 'Super Admin';
    $isAdmin = $user && $user->role && in_array($user->role->name, ['Super Admin', 'Admin']);
    $isEditor = $user && $user->role && in_array($user->role->name, ['Super Admin', 'Admin', 'Editor']);
    
    $menuItems = [
        [
            'title' => 'Dashboard',
            'url' => route('admin.dashboard.index'),
            'route' => 'admin.dashboard.index',
            'icon' => 'fa-solid fa-house',
            'visible' => true, // Tüm kullanıcılar görebilir
        ],
        [
            'title' => 'Admin List',
            'url' => route('admin.adminList'),
            'route' => 'admin.adminList',
            'icon' => 'fa-solid fa-users-cog',
            'visible' => $isAdmin, // Sadece Super Admin ve Admin görebilir
        ],
        [
            'title' => 'Blog List',
            'url' => route('admin.blog.index'),
            'route' => 'admin.blog.index',
            'icon' => 'fa-solid fa-book',
            'visible' => $isEditor, // Admin, Editor ve üstü görebilir
        ],
        [
            'title' => 'Categories',
            'url' => route('admin.category.index'),
            'route' => 'admin.category.index',
            'icon' => 'fa-solid fa-folder',
            'visible' => $isEditor, // Admin, Editor ve üstü görebilir
        ],
        [
            'title' => 'Authors',
            'url' => route('admin.author.index'),
            'route' => 'admin.author.index',
            'icon' => 'fa-solid fa-user-pen',
            'visible' => $isEditor, // Admin, Editor ve üstü görebilir
        ],
        [
            'title' => 'Profile',
            'url' => route('admin.profile'),
            'route' => 'admin.profile',
            'icon' => 'fa-solid fa-user',
            'visible' => true, // Tüm kullanıcılar görebilir
        ],
    ];
@endphp

<aside class="bg-white shadow-2xl lg:w-[15%] w-[35%] h-screen min-h-screen sticky top-0 left-0">


    <nav class="w-full h-full">
        <ul class="w-full h-full flex flex-col">
            <!-- Logo Section -->
            <li class="p-4 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-w text-white font-bold"></i>
                    </div>
                    <span class="font-bold text-lg text-gray-800">Warcraft</span>
                </div>
            </li>

            <!-- Menu Items -->
            @foreach ($menuItems as $item)
                @if ($item['visible'])
                    <li class="w-full">
                        <a href="{{ $item['url'] }}"
                            class="py-4 px-6 inline-flex items-center w-full hover:bg-gray-50 hover:text-blue-600 transition-all duration-200 border-l-4 border-transparent
                  @if (request()->routeIs($item['route'])) bg-blue-50 text-blue-600 border-l-blue-500 @else text-gray-700 @endif">
                            <i class="{{ $item['icon'] }} mr-3 text-lg"></i>
                            <span class="font-medium">{{ $item['title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

            <!-- Spacer to push content to bottom -->
            <li class="flex-grow"></li>

            <!-- User Info at Bottom - Profil resmi ile -->
            <li class="p-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center space-x-3">
                    @if ($user->profile_image)
                        <!-- Profil resmi varsa göster -->
                        <img src="{{ asset($user->profile_image) }}" 
                             alt="{{ $user->name }}" 
                             class="w-8 h-8 rounded-full object-cover border-2 border-gray-300">
                    @else
                        <!-- Profil resmi yoksa gradient ikon göster -->
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-white text-sm"></i>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->role ? $user->role->name : 'No Role' }}</p>
                    </div>
                </div>
            </li>
        </ul>
    </nav>

</aside>
