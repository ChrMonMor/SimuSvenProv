<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('subcategories')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'category_title' => 'required|string|max:255',
            'subcategory_ids' => 'array', // optional subcategory linkage
            'subcategory_ids.*' => 'exists:subcategories,subcategory_id',
        ]);

        $category = Category::create($request->only(['customer_id', 'category_title']));

        if ($request->has('subcategory_ids')) {
            $category->subcategories()->sync($request->subcategory_ids);
        }

        return response()->json($category->load('subcategories'), 201);
    }

    public function attachSubcategory($categoryId, $subcategoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->subcategories()->attach($subcategoryId);
        return response()->json(['message' => 'Subcategory attached']);
    }

    public function detachSubcategory($categoryId, $subcategoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->subcategories()->detach($subcategoryId);
        return response()->json(['message' => 'Subcategory detached']);
    }
}
