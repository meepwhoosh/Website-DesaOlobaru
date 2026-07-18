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
            'gambar' => 'nullable|image|max:2048',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['judul']) . '-' . time();
        $validated['tanggal_publikasi'] = $validated['tanggal_publikasi'] ?? now();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
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
            'gambar' => 'nullable|image|max:2048',
            'tanggal_publikasi' => 'nullable|date',
        ]);

        if ($request->judul !== $berita->judul) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['judul']) . '-' . time();
        }

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($berita->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        } elseif ($request->input('remove_gambar') == '1') {
            if ($berita->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($berita->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = null;
        }

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if ($berita->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($berita->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($berita->gambar);
        }
        
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
