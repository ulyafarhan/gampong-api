<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Event;
use App\Models\GovernmentStructure;
use App\Models\Guide;
use App\Models\Gallery;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the homepage.
     */
    public function home()
    {
        $latestArticles = Article::where('is_published', true)
                                 ->latest()
                                 ->take(3)
                                 ->get();

        $upcomingEvents = Event::where('start_time', '>=', now())
                               ->orderBy('start_time', 'asc')
                               ->take(3)
                               ->get();

        return view('home', [
            'latestArticles' => $latestArticles,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }

    /**
     * Display the profile page.
     */
    public function profile()
    {
        $governmentStructure = GovernmentStructure::orderBy('order', 'asc')->get();

        return view('profile', [
            'governmentStructure' => $governmentStructure,
        ]);
    }

    /**
     * Display the articles index page.
     */
    public function articlesIndex()
    {
        $articles = Article::where('is_published', true)
                           ->latest()
                           ->paginate(9);

        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Display a single article.
     */
    public function articleShow(Article $article)
    {
        // Abort if the article is not published
        if (!$article->is_published) {
            abort(404);
        }

        $relatedArticles = Article::where('is_published', true)
                                  ->where('id', '!=', $article->id)
                                  ->latest()
                                  ->take(3)
                                  ->get();

        return view('articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }

    /**
     * Display the guides index page.
     */
    public function guidesIndex()
    {
        $guides = Guide::orderBy('title')->paginate(12);
        return view('guides.index', ['guides' => $guides]);
    }

    /**
     * Display a single guide.
     */
    public function guideShow(Guide $guide)
    {
        return view('guides.show', ['guide' => $guide]);
    }

    /**
     * Display the events index page.
     */
    public function eventsIndex()
    {
        $upcomingEvents = Event::where('start_time', '>=', now())
                               ->orderBy('start_time', 'asc')
                               ->paginate(6);
        
        $pastEvents = Event::where('start_time', '<', now())
                           ->orderBy('start_time', 'desc')
                           ->paginate(6);

        return view('events.index', [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
        ]);
    }

    /**
     * Display the gallery page.
     */
    public function galleriesIndex()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('galleries.index', ['galleries' => $galleries]);
    }

    /**
     * Show the contact form.
     */
    public function contactCreate()
    {
        return view('contact.index');
    }

    /**
     * Store a new contact message.
     */
    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // For now, we just flash a success message.
        // In a real application, you would send an email or save to the database.
        // Mail::to('admin@gampongudeung.test')->send(new ContactFormMail($request->all()));

        return back()->with('success', 'Pesan Anda telah berhasil terkirim. Terima kasih!');
    }

    /**
     * Display a generic data table page.
     */
    public function dataTablePage()
    {
        $events = Event::latest()->paginate(15);
        return view('data-table', ['items' => $events, 'title' => 'Data Kegiatan']);
    }
}
