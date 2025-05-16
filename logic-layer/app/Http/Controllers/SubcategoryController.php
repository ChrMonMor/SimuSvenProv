<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return Subcategory::with('categories')->get();
    }

    public function show($id)
    {
        $subcategory = Subcategory::with('categories')->findOrFail($id);
        return response()->json($subcategory);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'subcategory_title' => 'required|string|max:255',
        ]);

        $subcategory = Subcategory::create($request->only(['customer_id', 'subcategory_title']));

        return response()->json($subcategory, 201);
    }

    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $request->validate([
            'subcategory_title' => 'required|string|max:255',
        ]);

        $subcategory->update([
            'subcategory_title' => $request->subcategory_title,
        ]);

        return response()->json($subcategory);
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully']);
    }
}
