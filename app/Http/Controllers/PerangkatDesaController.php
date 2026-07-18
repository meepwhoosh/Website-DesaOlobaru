<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        $perangkats = PerangkatDesa::latest()->get();
        return view('admin.perangkat.index', compact('perangkats'));
    }

    public function create()
    {
        return view('admin.perangkat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'kategori' => 'required|in:pemdes,bpd',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('perangkat', 'public');
        }

        PerangkatDesa::create($validated);

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat Desa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        return view('admin.perangkat.edit', compact('perangkat'));
    }

    public function update(Request $request, $id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'kategori' => 'required|in:pemdes,bpd',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($perangkat->gambar && Storage::disk('public')->exists($perangkat->gambar)) {
                Storage::disk('public')->delete($perangkat->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('perangkat', 'public');
        } elseif ($request->input('remove_gambar') == '1') {
            if ($perangkat->gambar && Storage::disk('public')->exists($perangkat->gambar)) {
                Storage::disk('public')->delete($perangkat->gambar);
            }
            $validated['gambar'] = null;
        }

        $perangkat->update($validated);

        return redirect()->route('admin.perangkat.index')->with('success', 'Data Perangkat Desa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $perangkat = PerangkatDesa::findOrFail($id);
        
        if ($perangkat->gambar && Storage::disk('public')->exists($perangkat->gambar)) {
            Storage::disk('public')->delete($perangkat->gambar);
        }
        
        $perangkat->delete();

        return redirect()->route('admin.perangkat.index')->with('success', 'Perangkat Desa berhasil dihapus!');
    }
}
