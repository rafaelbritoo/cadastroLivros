<?php
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\RelatorioController;

use Illuminate\Support\Facades\Route;

// Rotas relacionadas a LIVRO
Route::get('/', [LivroController::class, 'index'])->name('livro.index');
Route::get('/create-livro', [LivroController::class, 'create'])->name('livro.create');
Route::get('/show/{livro}', [LivroController::class, 'show'])->name('livro.show');
Route::get('/edit/{livro}', [LivroController::class, 'edit'])->name('livro.edit');
Route::post('/store-livro', [LivroController::class, 'store'])->name('store-livro');
Route::put('/update-livro/{livro}', [LivroController::class, 'update'])->name('update-livro');
Route::delete('/destroy-livro/{livro}', [LivroController::class, 'destroy'])->name('livro.destroy');

// Rotas relacionadas a AUTOR
Route::get('/autor', [AutorController::class, 'index'])->name('autor.index');
Route::get('/create-autor', [AutorController::class, 'create'])->name('autor.create');
Route::get('/autor/show/{autor}', [AutorController::class, 'show'])->name('autor.show');
Route::get('/autor/edit/{autor}', [AutorController::class, 'edit'])->name('autor.edit');
Route::post('/store-autor', [AutorController::class, 'store'])->name('store-autor');
Route::put('/update-autor/{autor}', [AutorController::class, 'update'])->name('update-autor');
Route::delete('/destroy-autor/{autor}', [AutorController::class, 'destroy'])->name('autor.destroy');

// Rotas relacionadas a ASSUNTO
Route::get('/assunto', [AssuntoController::class, 'index'])->name('assunto.index');
Route::get('/create-assunto', [AssuntoController::class, 'create'])->name('assunto.create');
Route::get('/assunto/show/{assunto}', [AssuntoController::class, 'show'])->name('assunto.show');
Route::get('/assunto/edit/{assunto}', [AssuntoController::class, 'edit'])->name('assunto.edit');
Route::post('/store-assunto', [AssuntoController::class, 'store'])->name('store-assunto');
Route::put('/update-assunto/{assunto}', [AssuntoController::class, 'update'])->name('update-assunto');
Route::delete('/destroy-assunto/{assunto}', [AssuntoController::class, 'destroy'])->name('assunto.destroy');

// Rotas relacionadas a RELATORIO
Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
Route::get('/relatorio/export/pdf', [RelatorioController::class, 'exportPdf'])->name('relatorio.export.pdf');
Route::get('/relatorio/export/excel', [RelatorioController::class, 'exportExcel'])->name('relatorio.export.excel');


