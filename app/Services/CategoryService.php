<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    public function list()
    {
        return Category::paginate(5);
    }

    public function store(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
