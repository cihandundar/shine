<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id'
    ];

    // Alt kategoriler
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Üst kategori
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Kategorideki bloglar (many-to-many ilişki)
    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_category');
    }

    // Blog sayısı
    public function getBlogsCountAttribute()
    {
        return $this->blogs()->count();
    }
}
