<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'category_id'];

    // Relasi ke satu kategori (via foreign key category_id)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke banyak kategori (many-to-many, jika dipakai)
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
