<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;

class CategoryController extends Controller
{
    /**
     * Tüm kategorileri listele
     */
    public function index()
    {
        $categories = Category::withCount('blogs')->get();
        
        return view('front.pages.category', compact('categories'));
    }

    /**
     * Belirli bir kategorideki blog yazılarını göster
     */
    public function show($id)
    {
        $category = Category::withCount('blogs')->findOrFail($id);
        
        $blogs = Blog::where('status', 'published')
            ->whereHas('categories', function($query) use ($id) {
                $query->where('categories.id', $id);
            })
            ->with(['author', 'categories'])
            ->orderBy('published_date', 'desc')
            ->paginate(12);

        return view('front.pages.category-detail', compact('category', 'blogs'));
    }
}
