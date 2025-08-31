@extends('front.base')

@section('title', 'Home - Shine Blog')

@section('content')
<!-- Hero Section - Ana banner alanı -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">Welcome to Shine</h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-100">
            Discover amazing stories, insights, and knowledge from our talented authors
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#featured-posts" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
                Explore Posts
            </a>
            <a href="{{ route('about.index') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors duration-200">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- Featured Posts Section - Öne çıkan blog yazıları -->
<section id="featured-posts" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Featured Posts</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Latest articles from our community of writers covering technology, lifestyle, and more
            </p>
        </div>

        @if($blogs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                    <article class="blog-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300" data-category="{{ $blog->categories->first() ? $blog->categories->first()->id : '' }}">
                        <!-- Blog Image -->
                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-4xl text-white"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Blog Content -->
                        <div class="p-6">
                            <!-- Categories -->
                            @if($blog->categories->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($blog->categories->take(2) as $category)
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                                {{ $blog->title }}
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit($blog->content, 120) }}
                            </p>

                            <!-- Meta Information -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    @if($blog->author)
                                        @if($blog->author->profile_image)
                                            <img src="{{ asset('profile_images/' . $blog->author->profile_image) }}" alt="{{ $blog->author->name }}" class="w-6 h-6 rounded-full object-cover">
                                        @else
                                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-xs text-white"></i>
                                            </div>
                                        @endif
                                        <span>{{ $blog->author->name }}</span>
                                    @endif
                                </div>
                                <span>{{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->format('M d, Y') : 'Draft' }}</span>
                            </div>

                            <!-- Read More Button -->
                            <div class="mt-4">
                                <a href="{{ route('blog.show', $blog->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- View All Posts Button -->
            <div class="text-center mt-12">
                <a href="{{ route('archive.index') }}" class="inline-block bg-gray-800 text-white px-8 py-3 rounded-lg hover:bg-gray-900 transition-colors duration-200">
                    View All Posts
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-newspaper text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Posts Yet</h3>
                <p class="text-gray-500">Check back soon for amazing content!</p>
            </div>
        @endif
    </div>
</section>

<!-- Categories Section - Kategori listesi -->
@if($categories->count() > 0)
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Explore Categories</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Find content that interests you by browsing through our categories
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach($categories as $category)
                    <div class="text-center group">
                        <a href="{{ route('category.show', $category->id) }}" class="block p-6 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors duration-200">
                                <i class="fas fa-folder text-2xl text-blue-600"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $category->blogs_count }} posts</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Authors Section - Yazar listesi -->
@if($authors->count() > 0)
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Meet Our Authors</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Talented writers sharing their knowledge and experiences with our community
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($authors->take(6) as $author)
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow duration-200">
                        <div class="w-20 h-20 mx-auto mb-4">
                            @if($author->profile_image)
                                <img src="{{ asset('profile_images/' . $author->profile_image) }}" alt="{{ $author->name }}" class="w-full h-full rounded-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-2xl text-white"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $author->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $author->bio ?: 'Passionate writer sharing insights and stories.' }}</p>
                        <div class="flex justify-center space-x-3">
                            <span class="text-sm text-gray-500">{{ $author->blogs_count }} articles</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-colors duration-200 hidden">
    <i class="fas fa-arrow-up"></i>
</button>
@endsection
