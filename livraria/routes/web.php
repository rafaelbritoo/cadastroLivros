<?php
use App\Http\Controllers\AutorController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AutorController::class, 'index'])->name('autor.index');
Route::get('/create-autor', [AutorController::class, 'create'])->name('autor.create');
Route::get('/show/{autor}', [AutorController::class, 'show'])->name('autor.show');
Route::get('/edit/{autor}', [AutorController::class, 'edit'])->name('autor.edit');
Route::post('/store-autor', [AutorController::class, 'store'])->name('store-autor');
Route::put('/update-autor/{autor}', [AutorController::class, 'update'])->name('update-autor');
Route::delete('/destroy-autor/{autor}', [AutorController::class, 'destroy'])->name('autor.destroy');
