<?php

namespace App\Http\Controllers;

use App\Models\CategorySubcategory;
use Illuminate\Http\Request;

class CategorySubcategoryController extends Controller
{
    public function index()
    {
        return CategorySubcategory::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:categories,category_id',
            'subcategory_id' => 'required|integer|exists:subcategories,subcategory_id',
        ]);

        return CategorySubcategory::create($request->all());
    }

    public function show($id)
    {
        return CategorySubcategory::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $categorySubcategory = CategorySubcategory::findOrFail($id);
        $request->validate([
            'category_id' => 'required|integer|exists:categories,category_id',
            'subcategory_id' => 'required|integer|exists:subcategories,subcategory_id',
        ]);
        $categorySubcategory->update($request->all());
        return $categorySubcategory;
    }

    public function destroy($id)
    {
        CategorySubcategory::destroy($id);
        return response()->noContent();
    }
}

