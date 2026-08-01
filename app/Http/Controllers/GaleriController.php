<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|array|max:3',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:1024',
            'deskripsi' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('galeri', 'public');
            }
            $data['gambar'] = array_slice($gambarPaths, 0, 3);
        } else {
            $data['gambar'] = null;
        }

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto Galeri berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|array|max:3',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:1024',
            'deleted_gambar' => 'nullable|array',
            'deskripsi' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
        ]);

        $existingGambar = is_array($galeri->gambar) ? $galeri->gambar : (is_string($galeri->gambar) ? [$galeri->gambar] : []);

        if ($request->has('deleted_gambar')) {
            foreach ($request->deleted_gambar as $delImg) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($delImg)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($delImg);
                }
                $existingGambar = array_filter($existingGambar, fn($g) => $g !== $delImg);
            }
        }

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $existingGambar[] = $file->store('galeri', 'public');
            }
        }

        $existingGambar = array_slice(array_values($existingGambar), 0, 3);
        $data['gambar'] = empty($existingGambar) ? null : $existingGambar;

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        if (is_array($galeri->gambar)) {
            foreach ($galeri->gambar as $g) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($g)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($g);
                }
            }
        } elseif (is_string($galeri->gambar) && \Illuminate\Support\Facades\Storage::disk('public')->exists($galeri->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($galeri->gambar);
        }
        
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto Galeri berhasil dihapus');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:galeris,id'
        ]);

        $galeris = Galeri::whereIn('id', $request->ids)->get();
        foreach ($galeris as $galeri) {
            if (is_array($galeri->gambar)) {
                foreach ($galeri->gambar as $g) {
                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($g)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($g);
                    }
                }
            } elseif (is_string($galeri->gambar) && \Illuminate\Support\Facades\Storage::disk('public')->exists($galeri->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($galeri->gambar);
            }
            $galeri->delete();
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Foto Galeri terpilih berhasil dihapus');
    }
}
