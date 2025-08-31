<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Support\Str; // Str helper'ı ekliyoruz

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
        'published_at',
        'slug' // Slug alanını ekliyoruz
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'published_date' => 'date', // Yayınlanma tarihi için date cast eklendi
        'status' => 'string'
    ];

    // Model boot method'unda slug otomatik oluşturma
    protected static function boot()
    {
        parent::boot();
        
        // Blog oluşturulurken slug otomatik oluştur
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
        
        // Blog güncellenirken title değişirse slug'ı da güncelle
        static::updating(function ($blog) {
            if ($blog->isDirty('title') && empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    // Slug oluşturma method'u
    public function generateSlug()
    {
        $slug = Str::slug($this->title);
        $originalSlug = $slug;
        $count = 1;
        
        // Aynı slug varsa sayı ekle
        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        return $slug;
    }

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

    // Featured image URL'si
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return \Storage::disk('public')->url($this->featured_image);
        }
        return null;
    }

    // Image accessor - featured_image için alias
    public function getImageAttribute()
    {
        return $this->featured_image;
    }
}
