<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return Subcategory::with('categories')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'subcategory_title' => 'required|string|max:255',
        ]);

        return Subcategory::create($request->all());
    }

    public function show($id)
    {
        return Subcategory::with('categories')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->all());
        return $subcategory;
    }

    public function destroy($id)
    {
        Subcategory::destroy($id);
        return response()->noContent();
    }
}
