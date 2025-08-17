@php
    $menuItems = [
        [
            'title' => 'Profile',
            'url' => route('admin.profile'),
            'route' => 'admin.profile',
            'icon' => 'fa-solid fa-user',
        ],
    ];
@endphp
<header class="w-full flex justify-between shadow-2xl py-3">
    <a href="{{ route('admin.dashboard.index') }}" class="pl-3 py-3 flex items-center w-full">
        <img src="{{ asset('front/assets/images/logo.png') }}" alt="Logo" class="h-10 w-auto">
        <span class="font-bold text-3xl ml-2">Warcraft</span>
    </a>
    <div class="pr-5">
        <div class="pl-3 py-3 flex items-center w-full relative">
            <img id="logoDropdownBtn" src="{{ asset('front/assets/images/logo.png') }}" alt="Logo"
                class="h-10 w-auto cursor-pointer">

            <div id="logoDropdownMenu"
                class="absolute left-[-100px] rounded-lg top-full mt-2 w-40 bg-black shadow-xl transform scale-0 origin-top transition-transform duration-200 z-50"
                style="position: absolute;">
                <span
                    class="absolute top-[-10px] right-10 w-0 h-0 border-l-10 border-l-transparent border-r-10 border-r-transparent border-b-10 border-b-black"></span>

                <ul class="py-2">
                    @foreach ($menuItems as $item)
                        <li>
                            <a href="{{ $item['url'] }}" class="py-3 pl-3 inline-block w-full  text-white">
                                <i class="{{ $item['icon'] }} mr-2"></i> {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                    <a href="{{ route('admin.logout') }}" class="block py-3 pl-3 text-white">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>
                        Logout
                    </a>
                </ul>
            </div>
        </div>
    </div>
</header>
