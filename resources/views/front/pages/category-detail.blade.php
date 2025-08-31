@extends('front.base')

@section('title', $category->name . ' - Shine Blog')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-600 to-red-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home.index') }}" class="hover:text-orange-200">Home</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('category.index') }}" class="hover:text-orange-200">Categories</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-orange-200">{{ $category->name }}</li>
                </ol>
            </nav>

            <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $category->name }}</h1>
            <p class="text-xl md:text-2xl mb-8 text-orange-100">
                {{ $category->description ?: 'Explore articles in this category' }}
            </p>
            <div class="text-lg text-orange-200">
                {{ $category->blogs_count }} articles available
            </div>
        </div>
    </div>
</section>

<!-- Category Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                @if($blogs->count() > 0)
                    <div class="space-y-8">
                        @foreach($blogs as $blog)
                            <article class="blog-item border-b border-gray-200 pb-8 last:border-b-0">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="md:col-span-1">
                                        <div class="h-48 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">
                                            @if($blog->image)
                                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gradient-to-br from-orange-400 to-red-600 flex items-center justify-center">
                                                    <i class="fas fa-newspaper text-4xl text-white"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="flex items-center gap-2 mb-3">
                                            @if($blog->categories->count() > 0)
                                                @foreach($blog->categories->take(2) as $cat)
                                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">{{ $cat->name }}</span>
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
                        {{ $blogs->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-folder-open text-6xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No Articles Found</h3>
                        <p class="text-gray-500">This category doesn't have any published articles yet.</p>
                        <div class="mt-6">
                            <a href="{{ route('archive.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                Browse All Articles
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Category Info -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Category Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-500">Name:</span>
                            <p class="font-medium text-gray-800">{{ $category->name }}</p>
                        </div>
                        @if($category->description)
                            <div>
                                <span class="text-sm text-gray-500">Description:</span>
                                <p class="text-gray-700">{{ $category->description }}</p>
                            </div>
                        @endif
                        <div>
                            <span class="text-sm text-gray-500">Total Articles:</span>
                            <p class="font-medium text-blue-600">{{ $category->blogs_count }}</p>
                        </div>
                    </div>
                </div>

                <!-- Other Categories -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">Explore Other Categories</h3>
                    <div class="space-y-2">
                        <a href="{{ route('archive.index') }}" class="block text-blue-700 hover:text-blue-900 transition-colors duration-200">
                            All Categories
                        </a>
                        <a href="{{ route('category.index') }}" class="block text-blue-700 hover:text-blue-900 transition-colors duration-200">
                            Category Overview
                        </a>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="bg-gradient-to-br from-orange-600 to-red-600 text-white rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Stay Updated</h3>
                    <p class="text-orange-100 text-sm mb-4">Get the latest posts from this category</p>
                    <div class="space-y-3">
                        <input type="email" placeholder="Your email" class="w-full px-3 py-2 rounded text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <button class="w-full bg-white text-orange-600 px-4 py-2 rounded text-sm font-semibold hover:bg-gray-100 transition-colors duration-200">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
