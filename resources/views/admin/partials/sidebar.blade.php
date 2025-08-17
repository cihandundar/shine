@php
    $menuItems = [
        [
            'title' => 'Dashboard',
            'url' => route('admin.dashboard.index'),
            'route' => 'admin.dashboard.index',
            'icon' => 'fa-solid fa-house',
        ],
        [
            'title' => 'Blog List',
            'url' => route('admin.blog.index'),
            'route' => 'admin.blog.index',
            'icon' => 'fa-solid fa-book',
        ],
    ];
@endphp

<aside class="bg-white shadow-2xl lg:w-[15%] w-[35%] h-screen">

    <nav class="w-full">
        <ul class="w-full">


            @foreach ($menuItems as $item)
                <li class="w-full">
                    <a href="{{ $item['url'] }}"
                        class="py-3 pl-3 inline-flex items-center w-full hover:bg-black hover:text-white
              @if (request()->routeIs($item['route'])) bg-black text-white @endif">
                        <i class="{{ $item['icon'] }} mr-2"></i>
                        {{ $item['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>


</aside>
