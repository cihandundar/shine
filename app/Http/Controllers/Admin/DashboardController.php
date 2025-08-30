<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Author;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard ana sayfası - güncel istatistikleri ve bilgileri gösterir
     */
    public function index()
    {
        // Dashboard için gerekli verileri çek
        $data = [
            'totalBlogs' => Blog::count(), // Toplam blog sayısı
            'publishedBlogs' => Blog::where('status', 'published')->count(), // Yayınlanan blog sayısı
            'draftBlogs' => Blog::where('status', 'draft')->count(), // Taslak blog sayısı
            'totalAuthors' => Author::count(), // Toplam yazar sayısı
            'totalCategories' => Category::count(), // Toplam kategori sayısı
            'totalUsers' => User::count(), // Toplam kullanıcı sayısı
            'currentUser' => Auth::user(), // Şu anda giriş yapmış kullanıcı
            'recentBlogs' => Blog::with(['author', 'categories'])->latest()->take(5)->get(), // Son 5 blog
            'recentAuthors' => Author::latest()->take(5)->get(), // Son 5 yazar
            'blogStatusStats' => $this->getBlogStatusStats(), // Blog durum istatistikleri
            'categoryBlogCounts' => $this->getCategoryBlogCounts(), // Kategori bazında blog sayıları
            'authorBlogCounts' => $this->getAuthorBlogCounts(), // Yazar bazında blog sayıları
        ];

        return view('admin.pages.dashboard', compact('data'));
    }

    /**
     * Blog durum istatistiklerini getir
     */
    private function getBlogStatusStats()
    {
        return Blog::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();
    }

    /**
     * Kategori bazında blog sayılarını getir
     */
    private function getCategoryBlogCounts()
    {
        return Category::withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->take(10)
            ->get();
    }

    /**
     * Yazar bazında blog sayılarını getir
     */
    private function getAuthorBlogCounts()
    {
        return Author::withCount('blogs')
            ->orderBy('blogs_count', 'desc')
            ->take(10)
            ->get();
    }
}
