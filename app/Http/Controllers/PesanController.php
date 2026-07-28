<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'email_hp' => 'required|string|max:255',
            'isi_pesan' => 'required|string',
            'g-recaptcha-response' => 'required',
        ], [
            'g-recaptcha-response.required' => 'Mohon centang kotak "I\'m not a robot" untuk melanjutkan.'
        ]);

        // Validasi Google reCAPTCHA API
        $recaptchaResponse = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        if (!$recaptchaResponse->json('success')) {
            return back()->withInput()->withErrors(['g-recaptcha-response' => 'Validasi Google reCAPTCHA gagal. Silakan coba lagi.']);
        }

        \App\Models\Pesan::create([
            'nama_pengirim' => $request->nama_pengirim,
            'email_hp' => $request->email_hp,
            'subjek' => 'Pesan dari Pengunjung Web',
            'isi_pesan' => $request->isi_pesan,
            'status' => 'Belum Dibaca',
        ]);

        return back()->with('success', 'Pesan Anda berhasil terkirim! Admin desa akan merespon sesegera mungkin.');
    }

    public function index()
    {
        $pesans = \App\Models\Pesan::latest()->get();
        return view('admin.pesan.index', compact('pesans'));
    }

    public function show($id)
    {
        $pesan = \App\Models\Pesan::findOrFail($id);
        
        if ($pesan->status === 'Belum Dibaca') {
            $pesan->update(['status' => 'Sudah Dibaca']);
        }

        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy($id)
    {
        $pesan = \App\Models\Pesan::findOrFail($id);
        $pesan->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus!');
    }
}
