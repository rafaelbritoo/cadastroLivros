<?php
namespace App\Services;

use App\Models\Livro;
use App\Models\LivroAutor;
use App\Models\LivroAssunto;
use Illuminate\Support\Facades\DB;

class LivroService
{
    public function createLivro(array $data): Livro
    {
        return DB::transaction(function () use ($data) {
            $livro = Livro::create($data);

            if (!empty($data['codAu'])) {
                LivroAutor::create([
                    'livro_codl' => $livro->codl,
                    'autor_codAu' => $data['codAu'],
                ]);
            }

            if (!empty($data['codAs'])) {
                LivroAssunto::create([
                    'livro_codl' => $livro->codl,
                    'assunto_codAs' => $data['codAs'],
                ]);
            }

            return $livro;
        });
    }

    public function updateLivro(Livro $livro, array $data): Livro
    {
        return DB::transaction(function () use ($livro, $data) {
            $livro->update($data);

            LivroAutor::updateOrInsert(
                ['livro_codl' => $livro->codl],
                ['autor_codAu' => $data['codAu'] ?? null]
            );

            LivroAssunto::updateOrInsert(
                ['livro_codl' => $livro->codl],
                ['assunto_codAs' => $data['codAs'] ?? null]
            );

            return $livro;
        });
    }

    public function deleteLivro(Livro $livro): void
    {
        DB::transaction(function () use ($livro) {
            LivroAssunto::where('livro_codl', $livro->codl)->delete();
            LivroAutor::where('livro_codl', $livro->codl)->delete();
            $livro->delete();
        });
    }
}
