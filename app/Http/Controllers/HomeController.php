<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 artikel terbaru yang sudah di-publish
        $latestArticles = Article::where('is_published', true)
                                 ->orderBy('created_at', 'desc')
                                 ->take(3)
                                 ->get();

        // Kirim data artikel ke view 'home'
        return view('home', [
            'articles' => $latestArticles,
        ]);
    }
}