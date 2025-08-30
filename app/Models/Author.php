<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'bio',
        'profile_image',
        'website',
        'social_twitter',
        'social_linkedin',
        'social_instagram',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Blog yazıları
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    // Aktif yazarlar
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Blog sayısı
    public function getBlogsCountAttribute()
    {
        return $this->blogs()->count();
    }

    // Yayınlanan blog sayısı
    public function getPublishedBlogsCountAttribute()
    {
        return $this->blogs()->where('status', 'published')->count();
    }
}
