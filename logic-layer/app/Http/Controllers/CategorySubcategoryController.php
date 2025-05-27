<?php

namespace App\Http\Controllers;

use App\Models\CategorySubcategory;
use Illuminate\Http\Request;

class CategorySubcategoryController extends Controller
{
    public function index()
    {
        return CategorySubcategory::all();
        // return CategorySubcategory::with(['category', 'subcategory'])->get();
    }

    public function store(Request $request)
    {
        if (CategorySubcategory::where('category_id', $request->category_id)->where('subcategory_id', $request->subcategory_id)->exists()) {
            return response()->json(['message' => 'This category-subcategory pair already exists.'], 409);
        }

        return CategorySubcategory::create($request->all());
    }

    public function show($id)
    {
        return CategorySubcategory::with(['category', 'subcategory'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $categorySubcategory = CategorySubcategory::findOrFail($id);
        $request->validate([
            'category_id' => 'required|integer|exists:categories,category_id',
            'subcategory_id' => 'required|integer|exists:subcategories,subcategory_id',
        ]);
        $categorySubcategory->update($request->all());
        return response()->json($categorySubcategory, 200);
    }

    public function destroy($id)
    {
        CategorySubcategory::destroy($id);
        return response()->noContent();
    }
}

