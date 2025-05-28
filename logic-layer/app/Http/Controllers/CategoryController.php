<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {        
        return Category::all();
        // return Category::with('subcategories')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_title' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'customer_id' => $request->customer_id,
            'category_title' => $request->category_title,
        ]);

        return $category;
    }
    
    // Fetch all from one Customer
    public function findAll($id) 
    {
        return Category::where('customer_id', $id)->get();
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
