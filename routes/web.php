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
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/potensi-desa', [PageController::class, 'potensi'])->name('potensi');
Route::get('/data-desa', [PageController::class, 'dataDesa'])->name('data-desa');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

// Admin Routes
Route::prefix('admin')->group(function () {
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

        // UMKM CRUD
        Route::resource('umkm', App\Http\Controllers\UmkmController::class, [
            'names' => [
                'index' => 'admin.umkm.index',
                'create' => 'admin.umkm.create',
                'store' => 'admin.umkm.store',
                'edit' => 'admin.umkm.edit',
                'update' => 'admin.umkm.update',
                'destroy' => 'admin.umkm.destroy',
            ]
        ]);

        // Wisata CRUD
        Route::resource('wisata', App\Http\Controllers\WisataController::class, [
            'names' => [
                'index' => 'admin.wisata.index',
                'create' => 'admin.wisata.create',
                'store' => 'admin.wisata.store',
                'edit' => 'admin.wisata.edit',
                'update' => 'admin.wisata.update',
                'destroy' => 'admin.wisata.destroy',
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
    });
});
