@extends('admin.base')

@section('content')
<!-- Main container with proper padding -->
<section class="px-6 py-8 max-w-7xl mx-auto">
    <!-- Dashboard main title -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-2">Current system information and statistics</p>
    </div>

    <!-- Statistics cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total blog count -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Blogs</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $data['totalBlogs'] }}</p>
                </div>
            </div>
        </div>

        <!-- Published blog count -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Published</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $data['publishedBlogs'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total authors count -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Authors</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $data['totalAuthors'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total categories count -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Categories</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $data['totalCategories'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Blog Status Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Blog Status Distribution</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="blogStatusChart"></canvas>
            </div>
        </div>

        <!-- Category Blog Count Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Blog Count by Category</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Author Blog Count Chart -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Blog Count by Author</h2>
        <div class="relative" style="height: 400px;">
            <canvas id="authorChart"></canvas>
        </div>
    </div>

    <!-- Current user information -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Current User Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-600">Username</p>
                <p class="font-medium text-gray-900">{{ $data['currentUser']->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Email</p>
                <p class="font-medium text-gray-900">{{ $data['currentUser']->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Role Level</p>
                <p class="font-medium text-gray-900">{{ $data['currentUser']->role ? $data['currentUser']->role->name : 'No Role Assigned' }}</p>
            </div>
        </div>
    </div>

    <!-- Blog status statistics -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Blog Status Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($data['blogStatusStats'] as $status => $count)
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600 capitalize">{{ $status == 'published' ? 'Published' : ($status == 'draft' ? 'Draft' : $status) }}</p>
                <p class="text-2xl font-bold text-gray-900">{{ $count }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent blogs -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Blogs</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categories</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data['recentBlogs'] as $blog)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($blog->title, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $blog->author ? $blog->author->name : 'No Author' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $blog->categories->pluck('name')->implode(', ') ?: 'No Category' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $blog->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $blog->status === 'published' ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $blog->created_at ? $blog->created_at->format('d.m.Y H:i') : 'No Date' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No blogs added yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Category blog counts -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Blog Count by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($data['categoryBlogCounts'] as $category)
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-900">{{ $category->name }}</span>
                    <span class="text-2xl font-bold text-blue-600">{{ $category->blogs_count }}</span>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500">No categories added yet</div>
            @endforelse
        </div>
    </div>

    <!-- Author blog counts -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Blog Count by Author</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($data['authorBlogCounts'] as $author)
            <div class="p-4 bg-gray-50 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-900">{{ $author->name }}</span>
                    <span class="text-2xl font-bold text-purple-600">{{ $author->blogs_count }}</span>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500">No authors added yet</div>
            @endforelse
        </div>
    </div>

    <!-- System connections -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">System Connections and Relationships</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-3">Blog System</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• Blog ↔ Author (1:N) - Each blog belongs to one author</li>
                    <li>• Blog ↔ Category (N:N) - Blog can be in multiple categories</li>
                    <li>• Blog ↔ User (1:N) - Users can create blogs</li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-3">User System</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• User ↔ Role (N:1) - Each user has one role</li>
                    <li>• User ↔ Blog (1:N) - Users can write blogs</li>
                    <li>• User ↔ Profile (1:1) - Each user has a profile</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart data from PHP
const chartData = {
    blogStatus: @json($data['blogStatusStats']),
    categories: @json($data['categoryBlogCounts']),
    authors: @json($data['authorBlogCounts'])
};

// Blog Status Chart (Doughnut)
const blogStatusCtx = document.getElementById('blogStatusChart').getContext('2d');
new Chart(blogStatusCtx, {
    type: 'doughnut',
    data: {
        labels: Object.keys(chartData.blogStatus).map(status => 
            status === 'published' ? 'Published' : 
            status === 'draft' ? 'Draft' : status
        ),
        datasets: [{
            data: Object.values(chartData.blogStatus),
            backgroundColor: [
                '#10B981', // Green for published
                '#F59E0B', // Yellow for draft
                '#6B7280'  // Gray for other
            ],
            borderWidth: 2,
            borderColor: '#ffffff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});

// Category Chart (Bar)
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'bar',
    data: {
        labels: chartData.categories.map(cat => cat.name),
        datasets: [{
            label: 'Blog Count',
            data: chartData.categories.map(cat => cat.blogs_count),
            backgroundColor: '#3B82F6',
            borderColor: '#2563EB',
            borderWidth: 1,
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Author Chart (Horizontal Bar)
const authorCtx = document.getElementById('authorChart').getContext('2d');
new Chart(authorCtx, {
    type: 'bar',
    data: {
        labels: chartData.authors.map(author => author.name),
        datasets: [{
            label: 'Blog Count',
            data: chartData.authors.map(author => author.blogs_count),
            backgroundColor: '#8B5CF6',
            borderColor: '#7C3AED',
            borderWidth: 1,
            borderRadius: 4
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>
@endsection
