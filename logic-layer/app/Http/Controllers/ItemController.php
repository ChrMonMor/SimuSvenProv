<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Fetch all items
    public function index()
    {
        // Eager load relationships to avoid N+1 query problem
        return Item::with(['customer', 'tag', 'type', 'categorySubcategory'])->get();
    }

    // Fetch a single item by its ID
    public function show($id)
    {
        return Item::with(['customer', 'tag', 'type', 'categorySubcategory'])->findOrFail($id);
    }

    // Create a new item
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'item_title' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'item_release_date' => 'nullable|date',
            'tag_id' => 'required|exists:tags,tag_id',
            'type_id' => 'required|exists:types,type_id',
            'item_barcode_ean' => 'nullable|string|max:20',
            'item_barcode_upc' => 'nullable|string|max:20',
            'item_price' => 'nullable|numeric',
            'item_price_currency' => 'nullable|string|max:3',
            'category_subcategory_id' => 'required|exists:categories_subcategories,category_subcategory_id',
            'item_brand' => 'nullable|string|max:255',
            'item_model' => 'nullable|string|max:255',
        ]);

        $item = Item::create([
            'customer_id' => $request->customer_id,
            'item_title' => $request->item_title,
            'item_description' => $request->item_description,
            'item_release_date' => $request->item_release_date,
            'tag_id' => $request->tag_id,
            'type_id' => $request->type_id,
            'item_barcode_ean' => $request->item_barcode_ean,
            'item_barcode_upc' => $request->item_barcode_upc,
            'item_price' => $request->item_price,
            'item_price_currency' => $request->item_price_currency,
            'category_subcategory_id' => $request->category_subcategory_id,
            'item_brand' => $request->item_brand,
            'item_model' => $request->item_model,
        ]);

        return response()->json($item, 201);
    }

    // Update an existing item
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'item_title' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'item_release_date' => 'nullable|date',
            'tag_id' => 'required|exists:tags,tag_id',
            'type_id' => 'required|exists:types,type_id',
            'item_barcode_ean' => 'nullable|string|max:20',
            'item_barcode_upc' => 'nullable|string|max:20',
            'item_price' => 'nullable|numeric',
            'item_price_currency' => 'nullable|string|max:3',
            'category_subcategory_id' => 'required|exists:categories_subcategories,category_subcategory_id',
            'item_brand' => 'nullable|string|max:255',
            'item_model' => 'nullable|string|max:255',
        ]);

        $item->update([
            'customer_id' => $request->customer_id,
            'item_title' => $request->item_title,
            'item_description' => $request->item_description,
            'item_release_date' => $request->item_release_date,
            'tag_id' => $request->tag_id,
            'type_id' => $request->type_id,
            'item_barcode_ean' => $request->item_barcode_ean,
            'item_barcode_upc' => $request->item_barcode_upc,
            'item_price' => $request->item_price,
            'item_price_currency' => $request->item_price_currency,
            'category_subcategory_id' => $request->category_subcategory_id,
            'item_brand' => $request->item_brand,
            'item_model' => $request->item_model,
        ]);

        return response()->json($item);
    }

    // Delete an item
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }
}
