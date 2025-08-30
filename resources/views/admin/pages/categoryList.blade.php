@extends('admin.base')

@section('title', 'Category Management')

@section('content')
    <section class="container max-w-screen-xl mx-auto py-6 px-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Category Management</h1>
                <p class="text-gray-600">Organize your blog posts with categories</p>
            </div>
            <button onclick="openCategoryModal()" 
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center space-x-2">
                <i class="fa-solid fa-plus text-lg"></i>
                <span class="font-medium">Add New Category</span>
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

        <!-- Categories Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-medium text-gray-900">Categories</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ $category->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-pink-500 rounded-lg flex items-center justify-center">
                                            <i class="fa-solid fa-folder text-white text-sm"></i>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                            @if($category->description)
                                                <div class="text-sm text-gray-500">{{ Str::limit($category->description, 50) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $category->slug }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($category->parent)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $category->parent->name }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">Main Category</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $category->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Edit Button -->
                                        <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->description }}', {{ $category->parent_id ?? 'null' }})" 
                                                class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-50" 
                                                title="Edit Category">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        
                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    class="text-red-600 hover:text-red-800 transition-colors p-2 rounded-lg hover:bg-red-50" 
                                                    title="Delete Category">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Alt kategoriler -->
                            @foreach($category->children as $child)
                                <tr class="hover:bg-gray-50 transition-colors bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 pl-12">
                                        #{{ $child->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 bg-gradient-to-br from-blue-400 to-green-500 rounded-lg flex items-center justify-center">
                                                <i class="fa-solid fa-folder text-white text-xs"></i>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900">{{ $child->name }}</div>
                                                @if($child->description)
                                                    <div class="text-sm text-gray-500">{{ Str::limit($child->description, 50) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $child->slug }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ $category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $child->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <!-- Edit Button -->
                                            <button onclick="editCategory({{ $child->id }}, '{{ $child->name }}', '{{ $child->description }}', {{ $child->parent_id }})" 
                                                    class="text-blue-600 hover:text-blue-800 transition-colors p-2 rounded-lg hover:bg-blue-50" 
                                                    title="Edit Category">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.category.destroy', $child->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete this category?')"
                                                        class="text-red-600 hover:text-red-800 transition-colors p-2 rounded-lg hover:bg-red-50" 
                                                        title="Delete Category">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <i class="fa-solid fa-folder text-4xl mb-4 text-gray-300"></i>
                                        <p class="text-lg font-medium">No categories found</p>
                                        <p class="text-sm">Get started by creating your first category.</p>
                                        <button onclick="openCategoryModal()" 
                                                class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            <i class="fa-solid fa-plus mr-2"></i>
                                            Create First Category
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Category Modal -->
    <div id="categoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Add New Category</h3>
                </div>
                
                <form id="categoryForm" action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-4 space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        
                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">Parent Category</label>
                            <select id="parent_id" 
                                    name="parent_id" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Main Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeCategoryModal()"
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCategoryModal() {
            document.getElementById('categoryModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Add New Category';
            document.getElementById('categoryForm').action = '{{ route("admin.category.store") }}';
            document.getElementById('categoryForm').method = 'POST';
            // Form'dan _method hidden input'unu kaldır (yeni kategori ekleme için)
            const methodInput = document.querySelector('input[name="_method"]');
            if (methodInput) {
                methodInput.remove();
            }
            document.getElementById('name').value = '';
            document.getElementById('description').value = '';
            document.getElementById('parent_id').value = '';
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

        function editCategory(id, name, description, parentId) {
            document.getElementById('categoryModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Edit Category';
            // Route'u doğru şekilde oluştur - id parametresini Laravel route helper'ına gönder
            document.getElementById('categoryForm').action = '{{ route("admin.category.update", ":id") }}'.replace(':id', id);
            document.getElementById('categoryForm').method = 'POST';
            
            // Önce mevcut _method input'unu kaldır, sonra yenisini ekle
            const existingMethodInput = document.querySelector('input[name="_method"]');
            if (existingMethodInput) {
                existingMethodInput.remove();
            }
            document.getElementById('categoryForm').innerHTML += '<input type="hidden" name="_method" value="PUT">';
            
            document.getElementById('name').value = name;
            document.getElementById('description').value = description || '';
            document.getElementById('parent_id').value = parentId || '';
        }
    </script>
@endsection
