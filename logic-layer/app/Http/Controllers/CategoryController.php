<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            'customer_id' => 'required|integer',
            'category_title' => 'required|string|max:255',
        ]);

        return Category::create($request->all());
    }

    public function show($id)
    {
        return Category::with('subcategories')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return $category;
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return response()->noContent();
    }
}
