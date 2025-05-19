<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // Fetch all tags
    public function index()
    {
        return Tag::all();
    }

    // Fetch a single tag by its ID
    public function show($id)
    {
        return Tag::findOrFail($id);
    }

    // Create a new tag
    public function store(Request $request)
    {
        $request->validate([
            'tag_title' => 'required|string|max:255',
        ]);

        $tag = Tag::create([
            'tag_title' => $request->tag_title,
        ]);

        return response()->json($tag, 201);
    }

    // Update an existing tag
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'tag_title' => 'required|string|max:255',
        ]);

        $tag->update([
            'tag_title' => $request->tag_title,
        ]);

        return response()->json($tag);
    }

    // Delete a tag
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
