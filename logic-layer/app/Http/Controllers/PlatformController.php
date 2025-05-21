<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    // Fetch all platforms
    public function index()
    {
        return Platform::all();
    }

    // Fetch a single platform by its ID
    public function show($id)
    {
        return Platform::findOrFail($id);
    }

    // Create a new platform
    public function store(Request $request)
    {
        $request->validate([
            'platform_title' => 'required|string|max:255',
        ]);

        $platform = Platform::create([
            'platform_title' => $request->platform_title,
        ]);

        return response()->json($platform, 201);
    }

    // Update an existing platform
    public function update(Request $request, $id)
    {
        $platform = Platform::findOrFail($id);

        $request->validate([
            'platform_title' => 'required|string|max:255',
        ]);

        $platform->update([
            'platform_title' => $request->platform_title,
        ]);

        return response()->json($platform);
    }

    // Delete a platform
    public function destroy($id)
    {
        $platform = Platform::findOrFail($id);
        $platform->delete();

        return response()->json(['message' => 'platform deleted successfully']);
    }
}
