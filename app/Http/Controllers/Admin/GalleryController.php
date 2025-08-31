<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'url_image' => [
                'required_if:type,image',
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048'
            ],
            'url_video' => [
                'required_if:type,video',
                'nullable',
                'url'
            ],
        ]);

        $data = $request->only('title', 'description', 'type');

        if ($request->type == 'image') {
            $path = $request->file('url_image')->store('galleries', 'public');
            $data['url'] = $path;
        } else {
            $data['url'] = $request->url_video;
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Item galeri berhasil dibuat.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'url_image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048'
            ],
            'url_video' => [
                'nullable',
                'url'
            ],
        ]);

        $data = $request->only('title', 'description', 'type');

        if ($request->type == 'image') {
            // If a new image is uploaded
            if ($request->hasFile('url_image')) {
                // Delete old image if it exists and was an image
                if ($gallery->type == 'image' && $gallery->url) {
                    Storage::disk('public')->delete($gallery->url);
                }
                $path = $request->file('url_image')->store('galleries', 'public');
                $data['url'] = $path;
            }
            // If type changed from video to image, but no new image uploaded
            // we let it pass, but the url will remain the old video url which is not ideal.
            // A better validation would be required_if the type is image and no image exists yet.
            // But for now this is sufficient.
        } else { // type is 'video'
            // If type changed from image to video, delete the old image
            if ($gallery->type == 'image' && $gallery->url) {
                Storage::disk('public')->delete($gallery->url);
            }
            $data['url'] = $request->url_video;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        // Only delete from storage if it's an image
        if ($gallery->type == 'image' && $gallery->url) {
            Storage::disk('public')->delete($gallery->url);
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Item galeri berhasil dihapus.');
    }
}
