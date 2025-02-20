<?php

namespace App\Repositories;

use App\Models\Category;

class CategoriesRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function getWithPostCount()
    {
        return Category::withCount('posts')->get();
    }
}
