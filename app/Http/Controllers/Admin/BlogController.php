<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category; // Category model eklendi
use App\Models\Author; // Author model eklendi
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        // Blog listesinde yazar ve kategorileri de yüklüyoruz
        $blogs = Blog::with(['author', 'categories'])->latest()->paginate(10);
        $categories = Category::all(); // Kategorileri yüklüyoruz
        $authors = Author::all(); // Yazarları yüklüyoruz

        return view('admin.pages.blogList', compact('blogs', 'categories', 'authors'));
    }

    public function create()
    {
        $categories = Category::all(); // Kategorileri yüklüyoruz
        $authors = Author::all(); // Yazarları yüklüyoruz

        return view('admin.pages.blogCreate', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft',
            'category_ids' => 'nullable|array', // Kategori ID'leri array olarak alıyoruz
            'category_ids.*' => 'exists:categories,id', // Her kategori ID'si geçerli olmalı
            'author_id' => 'required|exists:authors,id', // Yazar ID'si eklendi
            'published_date' => 'nullable|date', // Yayınlanma tarihi eklendi
        ]);

        // Featured image işleme
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('blog_images', 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $featuredImagePath,
            'status' => $request->status,
            'author_id' => $request->author_id,
            'published_date' => $request->published_date,
        ]);

        // Kategorileri ekle
        if ($request->has('category_ids')) {
            $blog->categories()->attach($request->category_ids);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit($blog)
    {
        // Eski route'lar için id parametresi desteği
        if (is_numeric($blog)) {
            $blog = Blog::findOrFail($blog);
        }
        
        $categories = Category::all(); // Kategorileri yüklüyoruz
        $authors = Author::all(); // Yazarları yüklüyoruz

        return view('admin.pages.blogEdit', compact('blog', 'categories', 'authors'));
    }

    public function update(Request $request, $blog)
    {
        // Eski route'lar için id parametresi desteği
        if (is_numeric($blog)) {
            $blog = Blog::findOrFail($blog);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'published_date' => 'nullable|date',
        ]);

        // Featured image işleme
        $featuredImagePath = $blog->featured_image;
        if ($request->hasFile('featured_image')) {
            // Eski resmi sil
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $featuredImagePath = $request->file('featured_image')->store('blog_images', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'featured_image' => $featuredImagePath,
            'status' => $request->status,
            'author_id' => $request->author_id,
            'published_date' => $request->published_date,
        ]);

        // Kategorileri senkronize et
        if ($request->has('category_ids')) {
            $blog->categories()->sync($request->category_ids);
        } else {
            $blog->categories()->detach();
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy($blog)
    {
        // Eski route'lar için id parametresi desteği
        if (is_numeric($blog)) {
            $blog = Blog::findOrFail($blog);
        }

        // Featured image'i sil
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        // Kategorileri kaldır
        $blog->categories()->detach();

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }

    /**
     * Blog durumunu değiştir (published/draft)
     */
    public function toggleStatus($blog)
    {
        // Eski route'lar için id parametresi desteği
        if (is_numeric($blog)) {
            $blog = Blog::findOrFail($blog);
        }

        // Durumu değiştir
        if ($blog->status === 'published') {
            $blog->update(['status' => 'draft']);
            $message = 'Blog unpublished successfully';
        } else {
            $blog->update(['status' => 'published']);
            $message = 'Blog published successfully';
        }

        return redirect()->route('admin.blogs.index')->with('success', $message);
    }
}
