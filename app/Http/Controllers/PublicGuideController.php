<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;

class PublicGuideController extends Controller
{
    // Menampilkan semua panduan
    public function index()
    {
        $guides = Guide::where('is_published', true)->get();
        return view('public.guides.index', compact('guides'));
    }

    // Menampilkan satu panduan detail
    public function show(Guide $guide)
    {
        return view('public.guides.show', compact('guide'));
    }
}