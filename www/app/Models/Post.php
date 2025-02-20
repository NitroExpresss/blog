<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use AsSource;
    protected $fillable = ['title', 'slug', 'description', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

