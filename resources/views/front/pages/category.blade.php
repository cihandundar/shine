@extends('front.base')

@section('title', 'Categories - Shine Blog')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-orange-600 to-red-600 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">Categories</h1>
        <p class="text-xl md:text-2xl mb-8 text-orange-100">
            Explore content organized by topics that interest you
        </p>
    </div>
</section>

<!-- Categories Grid -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($categories as $category)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-folder text-6xl text-white"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $category->name }}</h3>
                            <p class="text-gray-600 mb-4">
                                {{ $category->description ?: 'Explore articles in this category.' }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">{{ $category->blogs_count }} articles</span>
                                <a href="{{ route('category.show', $category->id) }}" class="text-blue-600 hover:text-blue-700 font-medium">Explore →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-folder-open text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Categories Yet</h3>
                <p class="text-gray-500">Categories will appear here once they are created.</p>
            </div>
        @endif
    </div>
</section>

<!-- Category Statistics -->
@if($categories->count() > 0)
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Category Overview</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Get insights into our content distribution across different topics
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($categories->take(4) as $category)
                    <div class="text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ $category->blogs_count }}</div>
                        <div class="text-gray-600">{{ $category->name }} Articles</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Call to Action -->
<section class="py-16 bg-blue-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Explore?</h2>
        <p class="text-xl mb-8 text-blue-100">
            Start reading articles from your favorite categories today
        </p>
        <a href="{{ route('archive.index') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200">
            Browse All Articles
        </a>
    </div>
</section>
@endsection
