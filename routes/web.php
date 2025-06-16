<?php

use App\Livewire\Jabatan\Index;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
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
});

require __DIR__.'/auth.php';
