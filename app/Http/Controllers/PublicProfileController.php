<?php

namespace App\Http\Controllers;

use App\Models\GovernmentStructure;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        $officials = GovernmentStructure::orderBy('id', 'asc')->get();
        return view('public.profile.index', compact('officials'));
    }
}