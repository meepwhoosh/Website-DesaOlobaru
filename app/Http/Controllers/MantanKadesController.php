<?php

namespace App\Http\Controllers;

use App\Models\MantanKades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MantanKadesController extends Controller
{
    public function index()
    {
        $kades = MantanKades::orderBy('urutan', 'asc')->get();
        return view('admin.mantankades.index', compact('kades'));
    }

    public function create()
    {
        return view('admin.mantankades.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'masa_jabatan' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|max:1024'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('mantankades', 'public');
        }

        MantanKades::create($validated);
        return redirect()->route('admin.mantankades.index')->with('success', 'Data Riwayat Kades berhasil ditambahkan.');
    }

    public function edit(MantanKades $mantankade)
    {
        return view('admin.mantankades.edit', compact('mantankade'));
    }

    public function update(Request $request, MantanKades $mantankade)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'masa_jabatan' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'urutan' => 'required|integer',
            'foto' => 'nullable|image|max:1024'
        ]);

        if ($request->input('remove_foto') == '1' && $mantankade->foto) {
            if (Storage::disk('public')->exists($mantankade->foto)) {
                Storage::disk('public')->delete($mantankade->foto);
            }
            $validated['foto'] = null;
        }

        if ($request->hasFile('foto')) {
            if ($mantankade->foto && Storage::disk('public')->exists($mantankade->foto)) {
                Storage::disk('public')->delete($mantankade->foto);
            }
            $validated['foto'] = $request->file('foto')->store('mantankades', 'public');
        }

        $mantankade->update($validated);
        return redirect()->route('admin.mantankades.index')->with('success', 'Data Riwayat Kades berhasil diperbarui.');
    }

    public function destroy(MantanKades $mantankade)
    {
        if ($mantankade->foto && Storage::disk('public')->exists($mantankade->foto)) {
            Storage::disk('public')->delete($mantankade->foto);
        }
        $mantankade->delete();
        return redirect()->route('admin.mantankades.index')->with('success', 'Data Riwayat Kades berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:mantan_kades,id'
        ]);

        $kades = MantanKades::whereIn('id', $request->ids)->get();
        foreach ($kades as $k) {
            if ($k->foto && Storage::disk('public')->exists($k->foto)) {
                Storage::disk('public')->delete($k->foto);
            }
            $k->delete();
        }

        return redirect()->route('admin.mantankades.index')->with('success', 'Data Riwayat Kades terpilih berhasil dihapus.');
    }
}
