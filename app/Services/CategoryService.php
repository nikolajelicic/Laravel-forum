<?php

namespace App\Services;

use App\Repositories\CategoryRepositories;

class CategoryService {
    private $categoryRepositories;

    public function __construct(CategoryRepositories $categoryRepositories)
    {
        return $this->categoryRepositories = $categoryRepositories;
    }

    public function getAllCategories()
    {
        return $this->categoryRepositories->getAllCategories();
    }
}