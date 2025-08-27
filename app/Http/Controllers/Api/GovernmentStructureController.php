<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GovernmentStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GovernmentStructureController extends Controller
{
    /**
     * Display a listing of the government structures for public view.
     */
    public function index()
    {
        // Mengambil data dan mengurutkannya berdasarkan kolom 'order'
        $structures = GovernmentStructure::orderBy('order', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Government structures retrieved successfully.',
            'data' => $structures
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $structure = GovernmentStructure::find($id);

        if (!$structure) {
            return response()->json([
                'status' => 'error',
                'message' => 'Government structure not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Government structure retrieved successfully.',
            'data' => $structure
        ]);
    }

    // --- Endpoint untuk Panel Admin (dengan otentikasi) ---

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/structures', 'public');
        }

        $structure = GovernmentStructure::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imagePath,
            'order' => $request->order,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Government structure created successfully.',
            'data' => $structure
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $structure = GovernmentStructure::find($id);
        if (!$structure) {
            return response()->json([
                'status' => 'error',
                'message' => 'Government structure not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('image')) {
            if ($structure->image) {
                Storage::disk('public')->delete($structure->image);
            }
            $imagePath = $request->file('image')->store('images/structures', 'public');
        } else {
            $imagePath = $structure->image;
        }

        $structure->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imagePath,
            'order' => $request->order,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Government structure updated successfully.',
            'data' => $structure
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $structure = GovernmentStructure::find($id);
        if (!$structure) {
            return response()->json([
                'status' => 'error',
                'message' => 'Government structure not found.'
            ], 404);
        }

        if ($structure->image) {
            Storage::disk('public')->delete($structure->image);
        }

        $structure->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Government structure deleted successfully.'
        ]);
    }
}