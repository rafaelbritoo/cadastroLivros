<?php
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;

use Illuminate\Support\Facades\Route;

Route::get('/autor', [AutorController::class, 'index'])->name('autor.index');
Route::get('/create-autor', [AutorController::class, 'create'])->name('autor.create');
Route::get('/show/{autor}', [AutorController::class, 'show'])->name('autor.show');
Route::get('/edit/{autor}', [AutorController::class, 'edit'])->name('autor.edit');
Route::post('/store-autor', [AutorController::class, 'store'])->name('store-autor');
Route::put('/update-autor/{autor}', [AutorController::class, 'update'])->name('update-autor');
Route::delete('/destroy-autor/{autor}', [AutorController::class, 'destroy'])->name('autor.destroy');


Route::get('/assunto', [AssuntoController::class, 'index'])->name('assunto.index');
Route::get('/create-assunto', [AssuntoController::class, 'create'])->name('assunto.create');
Route::get('/assunto/show/{assunto}', [AssuntoController::class, 'show'])->name('assunto.show');
Route::get('/assunto/edit/{assunto}', [AssuntoController::class, 'edit'])->name('assunto.edit');
Route::post('/store-assunto', [AssuntoController::class, 'store'])->name('store-assunto');
Route::put('/update-assunto/{assunto}', [AssuntoController::class, 'update'])->name('update-assunto');
Route::delete('/destroy-assunto/{assunto}', [AssuntoController::class, 'destroy'])->name('assunto.destroy');
