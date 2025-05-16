<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return Type::all();
    }

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

    public function show($id)
    {
        $type = Type::findOrFail($id);
        return response()->json($type);
    }

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

    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();

        return response()->json(['message' => 'Type deleted successfully']);
    }
}
