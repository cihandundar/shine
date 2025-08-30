@extends('admin.base')

@section('title', 'Create New Blog')

@section('content')
    <section class="container max-w-screen-xl mx-auto py-6 px-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Blog</h1>
                <p class="text-gray-600">Add a new blog post to your website</p>
            </div>
            <a href="{{ route('admin.blog.index') }}" 
               class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center space-x-2">
                <i class="fa-solid fa-arrow-left text-lg"></i>
                <span class="font-medium">Back to Blog List</span>
            </a>
        </div>

        <!-- Blog Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Blog Title *</label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Enter blog title..."
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Blog Content *</label>
                            <textarea id="content" 
                                      name="content" 
                                      rows="12"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                      placeholder="Write your blog content here..."
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt (Optional)</label>
                            <textarea id="excerpt" 
                                      name="excerpt" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                      placeholder="Brief description of your blog post...">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Featured Image -->
                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                                <input type="file" 
                                       id="featured_image" 
                                       name="featured_image" 
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(this)">
                                <label for="featured_image" class="cursor-pointer">
                                    <i class="fa-solid fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="text-sm text-gray-600">Click to upload image</p>
                                    <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF up to 2MB</p>
                                </label>
                            </div>
                            <div id="imagePreview" class="hidden mt-3">
                                <img id="preview" src="" alt="Preview" class="w-full h-32 object-cover rounded-lg">
                            </div>
                            @error('featured_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categories -->
                        <div>
                            <label for="categories" class="block text-sm font-medium text-gray-700 mb-2">Categories *</label>
                            <div class="relative">
                                <div id="categoryInput" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors min-h-[48px] cursor-pointer bg-white">
                                    <div id="selectedCategories" class="flex flex-wrap gap-2">
                                        <span class="text-gray-500">Select categories...</span>
                                    </div>
                                </div>
                                
                                <!-- Hidden inputs for form submission -->
                                <div id="categoryInputs"></div>
                                
                                <!-- Dropdown -->
                                <div id="categoryDropdown" class="hidden absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                    @foreach($categories as $category)
                                        <div class="category-option px-4 py-2 hover:bg-blue-50 cursor-pointer flex items-center justify-between" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                            <span>{{ $category->name }}</span>
                                            <i class="fa-solid fa-check text-blue-600 hidden"></i>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Click to select multiple categories (at least one required)</p>
                            @error('category_ids')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div>
                            <label for="author_id" class="block text-sm font-medium text-gray-700 mb-2">Author *</label>
                            <select id="author_id" 
                                    name="author_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    required>
                                <option value="">Select an author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Date -->
                        <div>
                            <label for="published_date" class="block text-sm font-medium text-gray-700 mb-2">Published Date</label>
                            <input type="date" 
                                   id="published_date" 
                                   name="published_date" 
                                   value="{{ old('published_date') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <p class="mt-1 text-xs text-gray-500">When this post should be published (optional)</p>
                            @error('published_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                <i class="fa-solid fa-save text-lg"></i>
                                <span class="font-medium">Create Blog Post</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Kategori multi-select işlevselliği
        document.addEventListener('DOMContentLoaded', function() {
            const categoryInput = document.getElementById('categoryInput');
            const categoryDropdown = document.getElementById('categoryDropdown');
            const selectedCategories = document.getElementById('selectedCategories');
            const categoryIdsInput = document.getElementById('categoryIdsInput');
            const categoryOptions = document.querySelectorAll('.category-option');
            const form = document.querySelector('form');
            
            let selectedCategoryIds = [];
            let selectedCategoryNames = [];

            // Input'a tıklandığında dropdown'ı aç/kapat
            categoryInput.addEventListener('click', function(e) {
                e.stopPropagation();
                categoryDropdown.classList.toggle('hidden');
            });

            // Dropdown dışına tıklandığında kapat
            document.addEventListener('click', function() {
                categoryDropdown.classList.add('hidden');
            });

            // Kategori seçimi
            categoryOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const checkIcon = this.querySelector('.fa-check');
                    
                    if (selectedCategoryIds.includes(id)) {
                        // Kategoriyi kaldır
                        selectedCategoryIds = selectedCategoryIds.filter(catId => catId !== id);
                        selectedCategoryNames = selectedCategoryNames.filter(catName => catName !== name);
                        this.classList.remove('bg-blue-50');
                        checkIcon.classList.add('hidden');
                    } else {
                        // Kategoriyi ekle
                        selectedCategoryIds.push(id);
                        selectedCategoryNames.push(name);
                        this.classList.add('bg-blue-50');
                        checkIcon.classList.remove('hidden');
                    }
                    
                    updateSelectedCategories();
                });
            });

            // Seçili kategorileri güncelle
            function updateSelectedCategories() {
                if (selectedCategoryIds.length === 0) {
                    selectedCategories.innerHTML = '<span class="text-gray-500">Select categories...</span>';
                } else {
                    selectedCategories.innerHTML = selectedCategoryIds.map((id, index) => {
                        const name = selectedCategoryNames[index];
                        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 cursor-pointer hover:bg-blue-200 transition-colors" onclick="removeCategory('${id}')">
                                    ${name}
                                    <i class="fa-solid fa-times text-xs ml-1.5 text-blue-600"></i>
                                </span>`;
                    }).join('');
                }
                
                // Hidden input'ları güncelle - her kategori için ayrı input
                const categoryInputs = document.getElementById('categoryInputs');
                categoryInputs.innerHTML = '';
                
                selectedCategoryIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'category_ids[]';
                    input.value = id;
                    categoryInputs.appendChild(input);
                });
            }

            // Kategoriyi kaldır
            function removeCategory(id) {
                selectedCategoryIds = selectedCategoryIds.filter(catId => catId !== id);
                const option = document.querySelector(`[data-id="${id}"]`);
                if (option) {
                    option.classList.remove('bg-blue-50');
                    option.querySelector('.fa-check').classList.add('hidden');
                }
                updateSelectedCategories();
            }

            // Form submit kontrolü - en az bir kategori seçili olmalı
            form.addEventListener('submit', function(e) {
                if (selectedCategoryIds.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one category before submitting.');
                    
                    // Kategori input'unu vurgula
                    categoryInput.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                    setTimeout(() => {
                        categoryInput.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
                    }, 3000);
                    
                    return false;
                }
            });
        });
    </script>
@endsection
