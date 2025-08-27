<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GuideController extends Controller
{
    // Public Routes
    public function index()
    {
        $guides = Guide::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Guides retrieved successfully.',
            'data' => $guides
        ]);
    }

    public function show($slug)
    {
        $guide = Guide::where('slug', $slug)->first();
        if (!$guide) {
            return response()->json([
                'status' => 'error',
                'message' => 'Guide not found.'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Guide retrieved successfully.',
            'data' => $guide
        ]);
    }
    
    // Admin Routes (Authenticated)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|array',
            'steps' => 'required|string',
            'estimated_time' => 'nullable|string',
            'estimated_cost' => 'nullable|numeric',
            'tips' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $guide = Guide::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'requirements' => json_encode($request->requirements),
            'steps' => $request->steps,
            'estimated_time' => $request->estimated_time,
            'estimated_cost' => $request->estimated_cost,
            'tips' => $request->tips,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Guide created successfully.',
            'data' => $guide
        ], 201);
    }
    
    public function update(Request $request, $id)
    {
        $guide = Guide::find($id);
        if (!$guide) {
            return response()->json([
                'status' => 'error',
                'message' => 'Guide not found.'
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|array',
            'steps' => 'required|string',
            'estimated_time' => 'nullable|string',
            'estimated_cost' => 'nullable|numeric',
            'tips' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $guide->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'requirements' => json_encode($request->requirements),
            'steps' => $request->steps,
            'estimated_time' => $request->estimated_time,
            'estimated_cost' => $request->estimated_cost,
            'tips' => $request->tips,
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Guide updated successfully.',
            'data' => $guide
        ]);
    }
    
    public function destroy($id)
    {
        $guide = Guide::find($id);
        if (!$guide) {
            return response()->json([
                'status' => 'error',
                'message' => 'Guide not found.'
            ], 404);
        }
    
        $guide->delete();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Guide deleted successfully.'
        ]);
    }
}