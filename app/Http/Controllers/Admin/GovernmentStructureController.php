<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GovernmentStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GovernmentStructureController extends Controller
{
    public function index()
    {
        $members = GovernmentStructure::orderBy('order')->get();
        return view('admin.government-structures.index', compact('members'));
    }

    public function create()
    {
        return view('admin.government-structures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('government', 'public');
            $data['image'] = $path;
        }

        GovernmentStructure::create($data);

        return redirect()->route('admin.government-structures.index')->with('success', 'Anggota pemerintahan berhasil ditambahkan.');
    }

    public function edit(GovernmentStructure $governmentStructure)
    {
        return view('admin.government-structures.edit', compact('governmentStructure'));
    }

    public function update(Request $request, GovernmentStructure $governmentStructure)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'order' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($governmentStructure->image) {
                Storage::disk('public')->delete($governmentStructure->image);
            }
            $path = $request->file('image')->store('government', 'public');
            $data['image'] = $path;
        }

        $governmentStructure->update($data);

        return redirect()->route('admin.government-structures.index')->with('success', 'Data anggota pemerintahan berhasil diperbarui.');
    }

    public function destroy(GovernmentStructure $governmentStructure)
    {
        if ($governmentStructure->image) {
            Storage::disk('public')->delete($governmentStructure->image);
        }
        $governmentStructure->delete();

        return redirect()->route('admin.government-structures.index')->with('success', 'Data anggota pemerintahan berhasil dihapus.');
    }
}
