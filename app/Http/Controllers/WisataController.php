<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wisata;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::latest()->get();
        return view('admin.wisata.index', compact('wisatas'));
    }

    public function create()
    {
        return view('admin.wisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
        }

        Wisata::create($data);

        return redirect()->route('admin.wisata.index')->with('success', 'Data pariwisata berhasil ditambahkan.');
    }

    public function edit(Wisata $wisata)
    {
        return view('admin.wisata.edit', compact('wisata'));
    }

    public function update(Request $request, Wisata $wisata)
    {
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($wisata->gambar) {
                Storage::disk('public')->delete($wisata->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('wisata', 'public');
        } elseif ($request->input('remove_gambar') == '1') {
            if ($wisata->gambar) {
                Storage::disk('public')->delete($wisata->gambar);
            }
            $data['gambar'] = null;
        }

        $wisata->update($data);

        return redirect()->route('admin.wisata.index')->with('success', 'Data pariwisata berhasil diperbarui.');
    }

    public function destroy(Wisata $wisata)
    {
        if ($wisata->gambar) {
            Storage::disk('public')->delete($wisata->gambar);
        }
        $wisata->delete();

        return redirect()->route('admin.wisata.index')->with('success', 'Data pariwisata berhasil dihapus.');
    }
}
