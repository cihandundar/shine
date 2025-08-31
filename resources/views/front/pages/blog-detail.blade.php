@extends('front.base')

@section('title', $blog->title . ' - Shine Blog')

@section('content')
<!-- Blog Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home.index') }}" class="hover:text-blue-200">Home</a></li>
                    <li><span class="mx-2">/</span></li>
                    @if($blog->categories->count() > 0)
                        <li><a href="{{ route('category.show', $blog->categories->first()->id) }}" class="hover:text-blue-200">{{ $blog->categories->first()->name }}</a></li>
                        <li><span class="mx-2">/</span></li>
                    @endif
                    <li class="text-blue-200">{{ $blog->title }}</li>
                </ol>
            </nav>

            <!-- Blog Title -->
            <h1 class="text-3xl md:text-5xl font-bold mb-6">{{ $blog->title }}</h1>

            <!-- Blog Meta -->
            <div class="flex flex-wrap items-center gap-6 text-blue-100">
                @if($blog->author)
                    <div class="flex items-center space-x-2">
                        @if($blog->author->profile_image)
                            <img src="{{ asset('profile_images/' . $blog->author->profile_image) }}" alt="{{ $blog->author->name }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-sm text-white"></i>
                            </div>
                        @endif
                        <span>{{ $blog->author->name }}</span>
                    </div>
                @endif
                
                @if($blog->published_date)
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar"></i>
                        <span>{{ \Carbon\Carbon::parse($blog->published_date)->format('F d, Y') }}</span>
                    </div>
                @endif

                @if($blog->categories->count() > 0)
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-folder"></i>
                        <span>{{ $blog->categories->pluck('name')->implode(', ') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <article class="prose prose-lg max-w-none">
                    <!-- Featured Image -->
                    @if($blog->image)
                        <div class="mb-8">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-96 object-cover rounded-lg">
                        </div>
                    @else
                        <div class="mb-8 h-96 bg-gradient-to-br from-blue-400 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-6xl text-white"></i>
                        </div>
                    @endif

                    <!-- Blog Content -->
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($blog->content)) !!}
                    </div>

                    <!-- Tags -->
                    @if($blog->categories->count() > 0)
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($blog->categories as $category)
                                    <a href="{{ route('category.show', $category->id) }}" class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition-colors duration-200">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Author Bio -->
                    @if($blog->author)
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <div class="flex items-start space-x-4">
                                @if($blog->author->profile_image)
                                    <img src="{{ asset('profile_images/' . $blog->author->profile_image) }}" alt="{{ $blog->author->name }}" class="w-16 h-16 rounded-full object-cover">
                                @else
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-2xl text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">About {{ $blog->author->name }}</h3>
                                    <p class="text-gray-600">{{ $blog->author->bio ?: 'A passionate writer sharing insights and stories with our community.' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </article>

                <!-- Related Posts -->
                @if($relatedBlogs->count() > 0)
                    <div class="mt-16 pt-8 border-t border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Posts</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedBlogs as $relatedBlog)
                                <article class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                                    <div class="h-32 bg-gray-200">
                                        @if($relatedBlog->image)
                                            <img src="{{ asset('storage/' . $relatedBlog->image) }}" alt="{{ $relatedBlog->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                                                <i class="fas fa-newspaper text-2xl text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">
                                            <a href="{{ route('blog.show', $relatedBlog->id) }}" class="hover:text-blue-600">
                                                {{ $relatedBlog->title }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-3">
                                            {{ Str::limit($relatedBlog->content, 80) }}
                                        </p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            @if($relatedBlog->author)
                                                <span>{{ $relatedBlog->author->name }}</span>
                                            @endif
                                            @if($relatedBlog->published_date)
                                                <span>{{ \Carbon\Carbon::parse($relatedBlog->published_date)->format('M d, Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Share Buttons -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Share This Post</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-800 text-white rounded-full flex items-center justify-center hover:bg-blue-900 transition-colors duration-200">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors duration-200">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Table of Contents -->
                <div class="bg-blue-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">Quick Navigation</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#top" class="text-blue-700 hover:text-blue-900">Back to Top</a></li>
                        <li><a href="{{ route('archive.index') }}" class="text-blue-700 hover:text-blue-900">All Posts</a></li>
                        @if($blog->categories->count() > 0)
                            <li><a href="{{ route('category.show', $blog->categories->first()->id) }}" class="text-blue-700 hover:text-blue-900">More in {{ $blog->categories->first()->name }}</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Newsletter Signup -->
                <div class="bg-gradient-to-br from-blue-600 to-purple-600 text-white rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Stay Updated</h3>
                    <p class="text-blue-100 text-sm mb-4">Get the latest posts delivered to your inbox</p>
                    <div class="space-y-3">
                        <input type="email" placeholder="Your email" class="w-full px-3 py-2 rounded text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <button class="w-full bg-white text-blue-600 px-4 py-2 rounded text-sm font-semibold hover:bg-gray-100 transition-colors duration-200">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
