<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource for Admin.
     */
    public function adminIndex()
    {
        // Mengambil semua artikel, termasuk yang belum dipublikasi, untuk Panel Admin
        $articles = Article::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'All articles retrieved for admin panel.',
            'data' => $articles
        ]);
    }

    /**
     * Display a listing of the published resources.
     */
    public function index()
    {
        // Mengambil hanya artikel yang sudah dipublikasi untuk publik
        $articles = Article::where('is_published', true)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Articles retrieved successfully.',
            'data' => $articles
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->where('is_published', true)->first();

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Article retrieved successfully.',
            'data' => $article
        ]);
    }
    
    /**
     * Display the specified resource for Admin.
     */
    public function showForAdmin($slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Article retrieved for admin successfully.',
            'data' => $article
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
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
            $imagePath = $request->file('image')->store('images/articles', 'public');
        }

        $article = Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'is_published' => $request->is_published ?? false,
        ]);

        // Catatan: Logika untuk Gemini API akan ditambahkan di langkah berikutnya.

        return response()->json([
            'status' => 'success',
            'message' => 'Article created successfully.',
            'data' => $article
        ], 201);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan gambar baru jika ada, dan hapus yang lama
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $imagePath = $request->file('image')->store('images/articles', 'public');
        } else {
            $imagePath = $article->image;
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'is_published' => $request->is_published ?? false,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Article updated successfully.',
            'data' => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found.'
            ], 404);
        }

        // Hapus file gambar dari storage
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Article deleted successfully.'
        ]);
    }
}