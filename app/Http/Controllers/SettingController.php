<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        
        foreach ($data as $key => $value) {
            // Handle file upload if the value is a file
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $value = $file->store('settings', 'public');
            } elseif ($value === null && str_contains($key, 'foto')) {
                // Jangan timpa foto dengan null jika user tidak upload file baru
                continue;
            }
            
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
