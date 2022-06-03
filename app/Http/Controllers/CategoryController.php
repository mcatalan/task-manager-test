<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->list();
        return response()->json($categories);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = Category::create($request->toArray());
        return response()->json(true, 201);
    }

    public function update(Category $category, CategoryUpdateRequest $request): JsonResponse
    {
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();

        // $category->update($request->toArray());

        return response()->json($category);
    }

    public function destroy(Category $category): JsonResponse
    {
        return response()->json($category->delete());
    }
}
