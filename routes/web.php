<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\MisiController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\DataDesaController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/profil', [PageController::class, 'profil'])->name('profil');
Route::get('/struktur', [PageController::class, 'struktur'])->name('struktur');
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');

Route::get('/data-desa', [PageController::class, 'dataDesa'])->name('data-desa');
Route::get('/apbdes', [PageController::class, 'apbdes'])->name('apbdes');
Route::get('/apbdes/export/pdf', [App\Http\Controllers\ApbdesController::class, 'exportPdf'])->name('apbdes.export.pdf');
Route::get('/apbdes/export/excel', [App\Http\Controllers\ApbdesController::class, 'exportExcel'])->name('apbdes.export.excel');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak/kirim', [App\Http\Controllers\PesanController::class, 'store'])->name('kontak.kirim');
// Public API
Route::get('/api/visitor-stats', [PageController::class, 'visitorStatsAjax'])->name('api.visitor.stats');
Route::post('/berita/{id}/view', [PageController::class, 'incrementBeritaView'])->name('api.berita.view');

// Admin Routes
Route::prefix('admin_desa_olobaru')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Berita CRUD
        Route::get('/berita', [AdminController::class, 'beritaIndex'])->name('admin.berita.index');
        Route::get('/berita/create', [AdminController::class, 'beritaCreate'])->name('admin.berita.create');
        Route::post('/berita', [AdminController::class, 'beritaStore'])->name('admin.berita.store');
        Route::get('/berita/{id}/edit', [AdminController::class, 'beritaEdit'])->name('admin.berita.edit');
        Route::put('/berita/{id}', [AdminController::class, 'beritaUpdate'])->name('admin.berita.update');
        Route::delete('/berita/{id}', [AdminController::class, 'beritaDestroy'])->name('admin.berita.destroy');
        
        // Riwayat Pengunjung
        Route::get('/riwayat-pengunjung', [\App\Http\Controllers\VisitorController::class, 'index'])->name('admin.pengunjung.index');
        Route::delete('/riwayat-pengunjung/reset', [\App\Http\Controllers\VisitorController::class, 'reset'])->name('admin.pengunjung.reset');
        // Perangkat Desa CRUD
        Route::resource('perangkat', App\Http\Controllers\PerangkatDesaController::class, [
            'names' => [
                'index' => 'admin.perangkat.index',
                'create' => 'admin.perangkat.create',
                'store' => 'admin.perangkat.store',
                'edit' => 'admin.perangkat.edit',
                'update' => 'admin.perangkat.update',
                'destroy' => 'admin.perangkat.destroy',
            ]
        ]);


        // Sejarah CRUD
        Route::resource('sejarah', App\Http\Controllers\SejarahController::class, [
            'names' => [
                'index' => 'admin.sejarah.index',
                'create' => 'admin.sejarah.create',
                'store' => 'admin.sejarah.store',
                'edit' => 'admin.sejarah.edit',
                'update' => 'admin.sejarah.update',
                'destroy' => 'admin.sejarah.destroy',
            ]
        ]);

        // Mantan Kades CRUD
        Route::resource('mantankades', App\Http\Controllers\MantanKadesController::class, [
            'names' => [
                'index' => 'admin.mantankades.index',
                'create' => 'admin.mantankades.create',
                'store' => 'admin.mantankades.store',
                'edit' => 'admin.mantankades.edit',
                'update' => 'admin.mantankades.update',
                'destroy' => 'admin.mantankades.destroy',
            ]
        ]);

        // Misi CRUD
        Route::resource('misi', App\Http\Controllers\MisiController::class, [
            'names' => [
                'index' => 'admin.misi.index',
                'create' => 'admin.misi.create',
                'store' => 'admin.misi.store',
                'edit' => 'admin.misi.edit',
                'update' => 'admin.misi.update',
                'destroy' => 'admin.misi.destroy',
            ]
        ]);

        // Galeri CRUD
        Route::resource('galeri', App\Http\Controllers\GaleriController::class, [
            'names' => [
                'index' => 'admin.galeri.index',
                'create' => 'admin.galeri.create',
                'store' => 'admin.galeri.store',
                'edit' => 'admin.galeri.edit',
                'update' => 'admin.galeri.update',
                'destroy' => 'admin.galeri.destroy',
            ]
        ]);
        
        // Data Desa CRUD & Import
        Route::post('/data-desa/import', [DataDesaController::class, 'import'])->name('admin.data-desa.import');
        Route::get('/data-desa/download-excel/{filename}', [DataDesaController::class, 'downloadExcel'])->name('admin.data-desa.download-excel');
        Route::delete('/data-desa/delete-excel/{filename}', [DataDesaController::class, 'deleteExcel'])->name('admin.data-desa.delete-excel');
        Route::resource('data-desa', DataDesaController::class, [
            'names' => [
                'index' => 'admin.data-desa.index',
                'create' => 'admin.data-desa.create',
                'store' => 'admin.data-desa.store',
                'edit' => 'admin.data-desa.edit',
                'update' => 'admin.data-desa.update',
                'destroy' => 'admin.data-desa.destroy',
            ]
        ]);



        // APBDes
        Route::get('/apbdes', [App\Http\Controllers\ApbdesController::class, 'index'])->name('admin.apbdes.index');
        Route::post('/apbdes/import', [App\Http\Controllers\ApbdesController::class, 'import'])->name('admin.apbdes.import');
        Route::delete('/apbdes/delete-excel/{filename}', [App\Http\Controllers\ApbdesController::class, 'deleteExcel'])->name('admin.apbdes.delete-excel');

        // Pesan Masuk CRUD
        Route::resource('pesan', App\Http\Controllers\PesanController::class, [
            'only' => ['index', 'show', 'destroy'],
            'names' => [
                'index' => 'admin.pesan.index',
                'show' => 'admin.pesan.show',
                'destroy' => 'admin.pesan.destroy',
            ]
        ]);
    });
});
