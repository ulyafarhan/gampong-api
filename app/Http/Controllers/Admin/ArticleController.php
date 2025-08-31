<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:articles,title',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $data = $request->only('title', 'content');
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path;
        }

        // Gemini summary will be added here in a later step.
        $data['summary'] = ''; // Placeholder

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat.');
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:articles,title,' . $article->id,
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'nullable|boolean',
        ]);

        $data = $request->only('title', 'content');
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $path = $request->file('image')->store('articles', 'public');
            $data['image'] = $path;
        }

        // Gemini summary will be updated here in a later step.

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        // Delete image from storage
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}