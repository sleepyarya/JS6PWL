<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Daftarkan kolom mana aja yang boleh diisi user
    protected $fillable = ['category_name', 'color'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}