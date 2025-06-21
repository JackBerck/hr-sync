<?php

use App\Livewire\Jabatan\Index;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Jabatan Routes
    Route::get('jabatan', Index::class)->name('jabatan.index');
    Route::get('jabatan/create', \App\Livewire\Jabatan\Create::class)->name('jabatan.create');
    Route::get('jabatan/{id}/edit', \App\Livewire\Jabatan\Edit::class)->name('jabatan.edit');
    Route::get('jabatan/{id}', \App\Livewire\Jabatan\Show::class)->name('jabatan.show');

    // Unit Kerja Routes
    Route::get('unit-kerja', \App\Livewire\UnitKerja\Index::class)->name('unit-kerja.index');
    Route::get('unit-kerja/create', \App\Livewire\UnitKerja\Create::class)->name('unit-kerja.create');
    Route::get('unit-kerja/{id}/edit', \App\Livewire\UnitKerja\Edit::class)->name('unit-kerja.edit');
    Route::get('unit-kerja/{id}', \App\Livewire\UnitKerja\Show::class)->name('unit-kerja.show');

    // Pegawai Routes
    Route::get('pegawai', \App\Livewire\Pegawai\Index::class)->name('pegawai.index');
    Route::get('pegawai/create', \App\Livewire\Pegawai\Create::class)->name('pegawai.create');
    Route::get('pegawai/{id}/edit', \App\Livewire\Pegawai\Edit::class)->name('pegawai.edit');
    Route::get('pegawai/{id}', \App\Livewire\Pegawai\Show::class)->name('pegawai.show');

    // Cuti Routes
    Route::get('cuti', \App\Livewire\Cuti\Index::class)->name('cuti.index');
    Route::get('cuti/create', \App\Livewire\Cuti\Create::class)->name('cuti.create');
    Route::get('cuti/{id}/edit', \App\Livewire\Cuti\Edit::class)->name('cuti.edit');
    Route::get('cuti/{id}', \App\Livewire\Cuti\Show::class)->name('cuti.show');

    // Absensi Routes
    Route::get('absensi', \App\Livewire\Absensi\Index::class)->name('absensi.index');
    Route::get('absensi/create', \App\Livewire\Absensi\Create::class)->name('absensi.create');
    Route::get('absensi/{id}/edit', \App\Livewire\Absensi\Edit::class)->name('absensi.edit');
    Route::get('absensi/{id}', \App\Livewire\Absensi\Show::class)->name('absensi.show');
});

require __DIR__ . '/auth.php';
