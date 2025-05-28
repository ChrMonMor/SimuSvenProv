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
        return item::all();
        // return Item::with(['customer', 'type', 'categorySubcategory', 'platform'])->get();
    }

    // Fetch a single item by its ID
    public function show($id)
    {
        return Item::with(['customer', 'type', 'categorySubcategory', 'platform'])->findOrFail($id);
    }

    // Fetch all from one Customer
    public function findAll($id) 
    {
        return Item::where('customer_id', $id)->get();
    }

    // Create a new item
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'item_title' => 'nullable|string|max:255',
            'item_description' => 'nullable|string',
            'item_release_date' => 'nullable|date',
            'type_id' => 'nullable|exists:types,type_id',
            'item_barcode_ean' => 'nullable|string|max:20',
            'item_barcode_upc' => 'nullable|string|max:20',
            'item_price' => 'nullable|numeric',
            'item_price_currency' => 'nullable|string|max:3',
            'category_subcategory_id' => 'nullable|exists:categories_subcategories,category_subcategory_id',
            'item_brand' => 'nullable|string|max:255',
            'platform_id' => 'nullable|numeric',
        ]);

        $item = Item::create([
            'customer_id' => $request->customer_id,
            'item_title' => $request->item_title,
            'item_description' => $request->item_description,
            'item_release_date' => $request->item_release_date,
            'type_id' => $request->type_id,
            'item_barcode_ean' => $request->item_barcode_ean,
            'item_barcode_upc' => $request->item_barcode_upc,
            'item_price' => $request->item_price,
            'item_price_currency' => $request->item_price_currency,
            'category_subcategory_id' => $request->category_subcategory_id,
            'item_brand' => $request->item_brand,
            'platform_id' => $request->platform_id,
        ]);

        return response()->json($item, 201);
    }

    // Update an existing item
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'item_title' => 'nullable|string|max:255',
            'item_description' => 'nullable|string',
            'item_release_date' => 'nullable|date',
            'type_id' => 'nullable|exists:types,type_id',
            'item_barcode_ean' => 'nullable|string|max:20',
            'item_barcode_upc' => 'nullable|string|max:20',
            'item_price' => 'nullable|numeric',
            'item_price_currency' => 'nullable|string|max:3',
            'category_subcategory_id' => 'nullable|exists:categories_subcategories,category_subcategory_id',
            'item_brand' => 'nullable|string|max:255',
            'platform_id' => 'nullable|numeric',
        ]);

        $item->update([
            'customer_id' => $request->customer_id,
            'item_title' => $request->item_title,
            'item_description' => $request->item_description,
            'item_release_date' => $request->item_release_date,
            'type_id' => $request->type_id,
            'item_barcode_ean' => $request->item_barcode_ean,
            'item_barcode_upc' => $request->item_barcode_upc,
            'item_price' => $request->item_price,
            'item_price_currency' => $request->item_price_currency,
            'category_subcategory_id' => $request->category_subcategory_id,
            'item_brand' => $request->item_brand,
            'platform_id' => $request->platform_id,
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
