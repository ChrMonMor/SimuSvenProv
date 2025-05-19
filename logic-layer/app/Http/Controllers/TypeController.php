<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    // Fetch all types
    public function index()
    {
        return Type::all();
    }

    // Fetch a single type by its ID
    public function show($id)
    {
        return Type::findOrFail($id);
    }

    // Create a new type
    public function store(Request $request)
    {
        $request->validate([
            'type_title' => 'required|string|max:255',
        ]);

        $type = Type::create([
            'type_title' => $request->type_title,
        ]);

        return response()->json($type, 201);
    }

    // Update an existing type
    public function update(Request $request, $id)
    {
        $type = Type::findOrFail($id);

        $request->validate([
            'type_title' => 'required|string|max:255',
        ]);

        $type->update([
            'type_title' => $request->type_title,
        ]);

        return response()->json($type);
    }

    // Delete a type
    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();

        return response()->json(['message' => 'Type deleted successfully']);
    }
}
