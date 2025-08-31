<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    // Menampilkan semua artikel (dengan paginasi)
    public function index()
    {
        $articles = Article::where('is_published', true)
                           ->latest()
                           ->paginate(6); // Menampilkan 6 artikel per halaman

        return view('public.articles.index', compact('articles'));
    }

    // Menampilkan satu artikel detail
    public function show(Article $article)
    {
        // Ambil 3 artikel terbaru lainnya, kecuali yang sedang dibuka
        $latestArticles = Article::where('is_published', true)
                                 ->where('id', '!=', $article->id)
                                 ->latest()
                                 ->take(3)
                                 ->get();

        return view('public.articles.show', compact('article', 'latestArticles'));
    }
}