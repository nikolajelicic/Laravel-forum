<?php 

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepositories implements CategoryInterface {

    public function getAllCategories()
    {
        return Category::all();
    }
}
