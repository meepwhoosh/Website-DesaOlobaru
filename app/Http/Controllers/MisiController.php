<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Misi;

class MisiController extends Controller
{
    public function index()
    {
        $misis = Misi::orderBy('urutan', 'asc')->get();
        return view('admin.misi.index', compact('misis'));
    }

    public function create()
    {
        return view('admin.misi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'urutan' => 'required|integer',
            'konten' => 'required|string',
        ]);

        Misi::create($validated);
        return redirect()->route('admin.misi.index')->with('success', 'Data Misi berhasil ditambahkan.');
    }

    public function edit(Misi $misi)
    {
        return view('admin.misi.edit', compact('misi'));
    }

    public function update(Request $request, Misi $misi)
    {
        $validated = $request->validate([
            'urutan' => 'required|integer',
            'konten' => 'required|string',
        ]);

        $misi->update($validated);
        return redirect()->route('admin.misi.index')->with('success', 'Data Misi berhasil diperbarui.');
    }

    public function destroy(Misi $misi)
    {
        $misi->delete();
        return redirect()->route('admin.misi.index')->with('success', 'Data Misi berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:misis,id'
        ]);

        Misi::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.misi.index')->with('success', 'Data Misi terpilih berhasil dihapus.');
    }
}
