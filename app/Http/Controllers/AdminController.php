<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function beritaIndex()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }

    public function beritaCreate()
    {
        return view('admin.berita.create');
    }

    public function beritaStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|array|max:3',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:1024',
            'tanggal_publikasi' => 'nullable|date',
            'tanggal_kegiatan' => 'nullable|date',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['judul']) . '-' . time();
        $validated['tanggal_publikasi'] = $validated['tanggal_publikasi'] ?? now();

        if ($request->hasFile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $file) {
                $gambarPaths[] = $file->store('berita', 'public');
            }
            $validated['gambar'] = array_slice($gambarPaths, 0, 3);
        } else {
            $validated['gambar'] = null;
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'konten' => 'required',
            'gambar' => 'nullable|array|max:3',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:1024',
            'deleted_gambar' => 'nullable|array',
            'tanggal_publikasi' => 'nullable|date',
            'tanggal_kegiatan' => 'nullable|date',
        ]);

        if ($request->judul !== $berita->judul) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['judul']) . '-' . time();
        }

        $existingGambar = is_array($berita->gambar) ? $berita->gambar : (is_string($berita->gambar) ? [$berita->gambar] : []);

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
                $existingGambar[] = $file->store('berita', 'public');
            }
        }

        $existingGambar = array_slice(array_values($existingGambar), 0, 3);
        $validated['gambar'] = empty($existingGambar) ? null : $existingGambar;

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if (is_array($berita->gambar)) {
            foreach ($berita->gambar as $g) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($g)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($g);
                }
            }
        } elseif (is_string($berita->gambar) && \Illuminate\Support\Facades\Storage::disk('public')->exists($berita->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function beritaBulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:beritas,id'
        ]);

        $beritas = Berita::whereIn('id', $request->ids)->get();
        foreach ($beritas as $berita) {
            if (is_array($berita->gambar)) {
                foreach ($berita->gambar as $g) {
                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($g)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($g);
                    }
                }
            } elseif (is_string($berita->gambar) && \Illuminate\Support\Facades\Storage::disk('public')->exists($berita->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($berita->gambar);
            }
            $berita->delete();
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita terpilih berhasil dihapus!');
    }
}
