<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sejarah;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarahs = Sejarah::orderBy('tahun', 'asc')->get();
        return view('admin.sejarah.index', compact('sejarahs'));
    }

    public function create()
    {
        return view('admin.sejarah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:50',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        Sejarah::create($request->all());
        return redirect()->route('admin.sejarah.index')->with('success', 'Data Sejarah berhasil ditambahkan.');
    }

    public function edit(Sejarah $sejarah)
    {
        return view('admin.sejarah.edit', compact('sejarah'));
    }

    public function update(Request $request, Sejarah $sejarah)
    {
        $request->validate([
            'tahun' => 'required|string|max:50',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $sejarah->update($request->all());
        return redirect()->route('admin.sejarah.index')->with('success', 'Data Sejarah berhasil diperbarui.');
    }

    public function destroy(Sejarah $sejarah)
    {
        $sejarah->delete();
        return redirect()->route('admin.sejarah.index')->with('success', 'Data Sejarah berhasil dihapus.');
    }
}
