<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Category;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'author_id',
        'published_date', // Yayınlanma tarihi alanı eklendi
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'published_date' => 'date', // Yayınlanma tarihi için date cast eklendi
        'status' => 'string'
    ];

    // Blog yazarı
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Blog kategorileri (many-to-many ilişki - tek kategori için)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_category');
    }

    // Blog kategorisi (tek kategori için)
    public function category()
    {
        return $this->belongsToMany(Category::class, 'blog_category')->first();
    }

    // Blog durumu
    public function isPublished()
    {
        return $this->status === 'published';
    }

    // Blog taslağı
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    // Yayınlanma tarihi formatı
    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_date ? $this->published_date->format('M d, Y') : 'Not set';
    }

    // Kategori isimlerini virgülle ayırarak getir
    public function getCategoryNamesAttribute()
    {
        return $this->categories->pluck('name')->implode(', ');
    }
}
