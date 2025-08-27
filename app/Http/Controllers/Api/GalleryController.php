<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the public galleries.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Galleries retrieved successfully.',
            'data' => $galleries
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery item not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery item retrieved successfully.',
            'data' => $gallery
        ]);
    }
    
    // --- Endpoint untuk Panel Admin (dengan otentikasi) ---
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'file' => 'required_if:type,image|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'required_if:type,video|nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        $mediaUrl = null;
        if ($request->type === 'image') {
            $mediaUrl = $request->file('file')->store('images/galleries', 'public');
        } else {
            $mediaUrl = $request->url;
        }

        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'url' => $mediaUrl,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery item created successfully.',
            'data' => $gallery
        ], 201);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery item not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        $mediaUrl = $gallery->url;
        if ($request->hasFile('file') && $request->type === 'image') {
            if (str_starts_with($gallery->url, 'images/galleries/')) {
                Storage::disk('public')->delete($gallery->url);
            }
            $mediaUrl = $request->file('file')->store('images/galleries', 'public');
        } elseif ($request->type === 'video' && $request->has('url')) {
            if (str_starts_with($gallery->url, 'images/galleries/')) {
                Storage::disk('public')->delete($gallery->url);
            }
            $mediaUrl = $request->url;
        }

        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'url' => $mediaUrl,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery item updated successfully.',
            'data' => $gallery
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gallery item not found.'
            ], 404);
        }

        if ($gallery->type === 'image') {
            Storage::disk('public')->delete($gallery->url);
        }

        $gallery->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Gallery item deleted successfully.'
        ]);
    }
}