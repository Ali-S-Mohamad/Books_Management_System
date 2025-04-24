<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{

    protected CategoryService $service;
    public function __construct(CategoryService $service) {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->list());
    }

    public function store(StoreCategoryRequest $request)
    {
        return response()->json($this->service->store($request->validated()), 201);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return response()->json($this->service->update($category, $request->validated()));
    }

    public function destroy(Category $category)
    {
        $this->service->delete($category);
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
