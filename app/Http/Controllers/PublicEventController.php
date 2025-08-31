<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    // Menampilkan semua kegiatan
    public function index()
    {
        $events = Event::where('date', '>=', now())->orderBy('date', 'asc')->get();
        return view('public.events.index', compact('events'));
    }
}