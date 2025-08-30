<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index()
    {
        // Tüm blog yazarlarını getir
        $authors = Author::with('blogs')->get();
        
        return view('admin.pages.authorList', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:authors',
            'bio' => 'nullable|string|max:1000',
            'website' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|string|max:255',
            'social_linkedin' => 'nullable|string|max:255',
            'social_instagram' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        Author::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'website' => $request->website,
            'social_twitter' => $request->social_twitter,
            'social_linkedin' => $request->social_linkedin,
            'social_instagram' => $request->social_instagram,
            'is_active' => $request->has('is_active'),
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.author.index')->with('success', 'Author created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:authors,email,' . $id,
            'bio' => 'nullable|string|max:1000',
            'website' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|string|max:255',
            'social_linkedin' => 'nullable|string|max:255',
            'social_instagram' => 'nullable|string|max:255',
            'is_active' => 'boolean'
        ]);

        $author = Author::findOrFail($id);
        $author->update([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'website' => $request->website,
            'social_twitter' => $request->social_twitter,
            'social_linkedin' => $request->social_linkedin,
            'social_instagram' => $request->social_instagram,
            'is_active' => $request->has('is_active'),
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.author.index')->with('success', 'Author updated successfully!');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        // Blog yazıları varsa silme
        if ($author->blogs()->count() > 0) {
            return redirect()->route('admin.author.index')->with('error', 'Cannot delete author with existing blog posts');
        }

        $author->delete();
        
        return redirect()->route('admin.author.index')->with('success', 'Author deleted successfully!');
    }
}
