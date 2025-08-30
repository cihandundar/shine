@extends('admin.base')

@section('title', 'Blog Authors Management')

@section('content')
    <section class="container max-w-screen-xl mx-auto py-6 px-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Blog Authors Management</h1>
                <p class="text-gray-600">Manage blog authors and their information</p>
            </div>
            <button onclick="openAuthorModal()" 
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center space-x-2">
                <i class="fa-solid fa-plus text-lg"></i>
                <span class="font-medium">Add New Author</span>
            </button>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
                <i class="fa-solid fa-check-circle mr-3 text-green-500"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
                <i class="fa-solid fa-exclamation-circle mr-3 text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Authors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $authors->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fa-solid fa-user-check text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Authors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $authors->where('is_active', true)->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                        <i class="fa-solid fa-newspaper text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Posts</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $authors->sum('blogs_count') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Authors Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">Blog Authors List</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blog Posts</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($authors as $author)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($author->profile_image)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('profile_images/' . $author->profile_image) }}" alt="{{ $author->name }}">
                                            @else
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                                    <i class="fa-solid fa-user text-white text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $author->name }}</div>
                                            @if($author->bio)
                                                <div class="text-xs text-gray-500 truncate max-w-xs">{{ Str::limit($author->bio, 50) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $author->email }}</div>
                                    @if($author->website)
                                        <div class="text-xs text-blue-600">
                                            <a href="{{ $author->website }}" target="_blank" class="hover:underline">
                                                <i class="fa-solid fa-globe mr-1"></i>Website
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ $author->blogs->count() }}</span>
                                        @if($author->blogs->count() > 0)
                                            <span class="ml-2 text-xs text-gray-500">
                                                ({{ $author->blogs->where('status', 'published')->count() }} published)
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $author->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $author->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $author->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button onclick="editAuthor({{ $author->id }}, '{{ $author->name }}', '{{ $author->email }}', '{{ $author->bio }}', '{{ $author->website }}', '{{ $author->social_twitter }}', '{{ $author->social_linkedin }}', '{{ $author->social_instagram }}', {{ $author->is_active ? 'true' : 'false' }})" 
                                                class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        <button onclick="deleteAuthor({{ $author->id }}, '{{ $author->name }}', {{ $author->blogs->count() }})" 
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        @if($author->blogs->count() > 0)
                                            <a href="{{ route('admin.blog.index') }}?author={{ $author->id }}" 
                                               class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                                               title="View author's posts">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No authors found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Author Modal -->
    <div id="authorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Add New Blog Author</h3>
                    <button onclick="closeAuthorModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </div>
                
                <form id="authorForm" method="POST" action="{{ route('admin.author.store') }}">
                    @csrf
                    <input type="hidden" id="authorId" name="author_id">
                    <input type="hidden" name="_method" id="methodField" value="POST">
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Author Name</label>
                            <input type="text" id="name" name="name" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="col-span-2">
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                            <textarea id="bio" name="bio" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <div class="col-span-2">
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                            <input type="url" id="website" name="website" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="social_twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter</label>
                            <input type="text" id="social_twitter" name="social_twitter" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="social_linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                            <input type="text" id="social_linkedin" name="social_linkedin" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="col-span-2">
                            <label for="social_instagram" class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                            <input type="text" id="social_instagram" name="social_instagram" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" id="is_active" name="is_active" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Active Author</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeAuthorModal()" 
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                            Save Author
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <i class="fa-solid fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Author</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Are you sure you want to delete <span id="deleteAuthorName" class="font-medium"></span>? 
                    <span id="deleteWarning" class="text-red-600 font-medium"></span>
                </p>
                
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" 
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors duration-200">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Author modal functions
    function openAuthorModal() {
        document.getElementById('authorModal').classList.remove('hidden');
        document.getElementById('modalTitle').textContent = 'Add New Blog Author';
        document.getElementById('authorForm').action = '{{ route("admin.author.store") }}';
        document.getElementById('methodField').value = 'POST';
        document.getElementById('authorForm').reset();
        document.getElementById('is_active').checked = true;
    }

    function closeAuthorModal() {
        document.getElementById('authorModal').classList.add('hidden');
    }

    function editAuthor(id, name, email, bio, website, twitter, linkedin, instagram, isActive) {
        document.getElementById('authorModal').classList.remove('hidden');
        document.getElementById('modalTitle').textContent = 'Edit Blog Author';
        document.getElementById('authorForm').action = '{{ route("admin.author.update", ":id") }}'.replace(':id', id);
        document.getElementById('methodField').value = 'PUT';
        document.getElementById('authorId').value = id;
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;
        document.getElementById('bio').value = bio;
        document.getElementById('website').value = website;
        document.getElementById('social_twitter').value = twitter;
        document.getElementById('social_linkedin').value = linkedin;
        document.getElementById('social_instagram').value = instagram;
        document.getElementById('is_active').checked = isActive;
    }

    function deleteAuthor(id, name, blogCount) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteAuthorName').textContent = name;
        
        if (blogCount > 0) {
            document.getElementById('deleteWarning').textContent = 
                `This author has ${blogCount} blog post(s). They cannot be deleted until all posts are removed or reassigned.`;
            document.getElementById('deleteForm').style.display = 'none';
        } else {
            document.getElementById('deleteWarning').textContent = 'This action cannot be undone.';
            document.getElementById('deleteForm').style.display = 'inline';
        }
        
        document.getElementById('deleteForm').action = '{{ route("admin.author.destroy", ":id") }}'.replace(':id', id);
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const authorModal = document.getElementById('authorModal');
        const deleteModal = document.getElementById('deleteModal');
        
        if (event.target === authorModal) {
            closeAuthorModal();
        }
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
    }
</script>
@endsection
