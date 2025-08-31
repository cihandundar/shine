<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Author;

class HomeController extends Controller
{
    /**
     * Ana sayfa için blog, kategori ve yazar verilerini getir
     */
    public function index()
    {
        // Yayınlanmış blogları getir (en son eklenenler önce)
        $blogs = Blog::where('status', 'published')
            ->with(['author', 'categories'])
            ->orderBy('published_date', 'desc')
            ->take(6)
            ->get();

        // Tüm kategorileri getir (blog sayısı ile birlikte)
        $categories = Category::withCount('blogs')->get();

        // Tüm yazarları getir (blog sayısı ile birlikte)
        $authors = Author::withCount('blogs')->get();

        return view('front.pages.home', compact('blogs', 'categories', 'authors'));
    }

    /**
     * Blog detay sayfası
     */
    public function show($id)
    {
        $blog = Blog::with(['author', 'categories'])
            ->where('status', 'published')
            ->findOrFail($id);

        // İlgili blog yazıları (aynı kategorilerden)
        $relatedBlogs = Blog::where('status', 'published')
            ->where('id', '!=', $id)
            ->whereHas('categories', function($query) use ($blog) {
                $query->whereIn('categories.id', $blog->categories->pluck('id'));
            })
            ->with(['author', 'categories'])
            ->take(3)
            ->get();

        return view('front.pages.blog-detail', compact('blog', 'relatedBlogs'));
    }
}
