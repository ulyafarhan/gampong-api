<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::orderBy('title')->get();
        return view('admin.guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:guides,title',
            'description' => 'required|string',
            'steps' => 'required|string',
            'requirements' => 'nullable|array',
            'requirements.*' => 'nullable|string',
            'estimated_time' => 'nullable|string|max:255',
            'estimated_cost' => 'nullable|numeric',
            'tips' => 'nullable|string',
        ]);

        $data = $request->except('requirements');
        $data['slug'] = Str::slug($request->title);

        // Filter out null/empty values and encode requirements as JSON
        $requirements = $request->requirements ? array_filter($request->requirements) : [];
        $data['requirements'] = json_encode($requirements);

        Guide::create($data);

        return redirect()->route('admin.guides.index')->with('success', 'Panduan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     * Note: Not typically used in admin panels, but included for completeness.
     */
    public function show(Guide $guide)
    {
        return view('admin.guides.show', compact('guide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guide $guide)
    {
        return view('admin.guides.edit', compact('guide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guide $guide)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:guides,title,' . $guide->id,
            'description' => 'required|string',
            'steps' => 'required|string',
            'requirements' => 'nullable|array',
            'requirements.*' => 'nullable|string',
            'estimated_time' => 'nullable|string|max:255',
            'estimated_cost' => 'nullable|numeric',
            'tips' => 'nullable|string',
        ]);

        $data = $request->except('requirements');
        $data['slug'] = Str::slug($request->title);

        // Filter out null/empty values and encode requirements as JSON
        $requirements = $request->requirements ? array_filter($request->requirements) : [];
        $data['requirements'] = json_encode($requirements);

        $guide->update($data);

        return redirect()->route('admin.guides.index')->with('success', 'Panduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guide $guide)
    {
        $guide->delete();
        return redirect()->route('admin.guides.index')->with('success', 'Panduan berhasil dihapus.');
    }
}
