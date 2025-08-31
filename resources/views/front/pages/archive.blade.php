@extends('front.base')

@section('title', 'Archive - Shine Blog')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">Blog Archive</h1>
        <p class="text-xl md:text-2xl mb-8 text-green-100">
            Explore our complete collection of articles and stories
        </p>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="py-8 bg-gray-50 border-b">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('archive.index') }}" class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search Bar -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..." class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="flex items-center space-x-4">
                <label for="category" class="text-sm font-medium text-gray-700">Category:</label>
                <select name="category" id="category" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="all" {{ !request('category') || request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->blogs_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort Options -->
            <div class="flex items-center space-x-2">
                <label for="sort" class="text-sm font-medium text-gray-700">Sort:</label>
                <select name="sort" id="sort" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>By Title</option>
                </select>
            </div>
        </form>
    </div>
</section>

<!-- Archive Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                @if($blogs->count() > 0)
                    <div class="space-y-8">
                        @foreach($blogs as $blog)
                            <article class="blog-item searchable-item border-b border-gray-200 pb-8" data-category="{{ $blog->categories->first() ? $blog->categories->first()->id : '' }}">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="md:col-span-1">
                                        <div class="h-48 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                                            @if($blog->image)
                                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-green-400 to-blue-600 flex items-center justify-center">
                                                    <i class="fas fa-newspaper text-4xl text-white"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="flex items-center gap-2 mb-3">
                                            @if($blog->categories->count() > 0)
                                                @foreach($blog->categories->take(2) as $category)
                                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $category->name }}</span>
                                                @endforeach
                                            @endif
                                            <span class="text-sm text-gray-500">{{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->format('M d, Y') : 'Draft' }}</span>
                                        </div>
                                        <h2 class="text-2xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-200">
                                            <a href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a>
                                        </h2>
                                        <p class="text-gray-600 mb-4 leading-relaxed">
                                            {{ Str::limit($blog->content, 200) }}
                                        </p>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                @if($blog->author)
                                                    @if($blog->author->profile_image)
                                                        <img src="{{ asset('profile_images/' . $blog->author->profile_image) }}" alt="{{ $blog->author->name }}" class="w-8 h-8 rounded-full object-cover">
                                                    @else
                                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user text-xs text-white"></i>
                                                        </div>
                                                    @endif
                                                    <span class="text-sm text-gray-600">{{ $blog->author->name }}</span>
                                                @endif
                                            </div>
                                            <a href="{{ route('blog.show', $blog->id) }}" class="text-blue-600 hover:text-blue-700 font-medium">Read More →</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-12">
                        {{ $blogs->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-search text-6xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No Posts Found</h3>
                        <p class="text-gray-500">Try adjusting your search criteria or browse all categories.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Categories -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                            <a href="{{ route('archive.index', ['category' => $category->id]) }}" class="block text-gray-600 hover:text-blue-600 transition-colors duration-200">
                                {{ $category->name }} ({{ $category->blogs_count }})
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Search Tips -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">Search Tips</h3>
                    <ul class="text-sm text-blue-700 space-y-2">
                        <li>• Use specific keywords</li>
                        <li>• Try different categories</li>
                        <li>• Check spelling</li>
                        <li>• Use author names</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
