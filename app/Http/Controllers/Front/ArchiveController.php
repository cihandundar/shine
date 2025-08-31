<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;

class ArchiveController extends Controller
{
    /**
     * Tüm blog yazılarını arşiv sayfasında göster
     */
    public function index(Request $request)
    {
        $query = Blog::where('status', 'published')
            ->with(['author', 'categories']);

        // Kategori filtresi
        if ($request->has('category') && $request->category != 'all') {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Arama filtresi
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        // Sıralama
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('published_date', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->orderBy('published_date', 'desc');
        }

        $blogs = $query->paginate(12);
        $categories = Category::withCount('blogs')->get();

        return view('front.pages.archive', compact('blogs', 'categories'));
    }
}
