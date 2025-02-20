<?php

namespace App\Services;

use App\Repositories\CategoriesRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoriesRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategoriesWithPostCount()
    {
        return $this->categoryRepository->getWithPostCount();
    }
}
