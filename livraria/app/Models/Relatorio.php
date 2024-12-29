<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    protected $table = 'vw_catalogo_livros';

    // Escopo para filtrar por título
    public function scopeFilterByTitulo($query, $titulo)
    {
        if (!empty($titulo)) {
            return $query->where('livro_titulo', 'like', '%' . $titulo . '%');
        }
        return $query;
    }

    public function scopeFilterByAutor($query, $autor)
    {
        if (!empty($autor)) {
            return $query->where('autor_nome', 'like', '%' . $autor . '%');
        }
        return $query;
    }

    public function scopeFilterByAssunto($query, $assunto)
    {
        if (!empty($assunto)) {
            return $query->where('assunto_nome', 'like', '%' . $assunto . '%');
        }
        return $query;
    }

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        if (in_array($column, ['livro_titulo', 'autor_nome', 'valor_formatado'])) {
            return $query->orderBy($column, $direction);
        }
        return $query;
    }

    public function scopeFilterByEditora($query, $editora)
    {
        if (!empty($editora)) {
            return $query->where('editora', 'like', '%' . $editora . '%');
        }
        return $query;
    }

    public function scopeFilterByEdicao($query, $edicao)
    {
        if (!empty($edicao)) {
            return $query->where('edicao', '=', $edicao);
        }
        return $query;
    }

    public function scopeFilterByAnoPublicacao($query, $anoPublicacao)
    {
        if (!empty($anoPublicacao)) {
            return $query->where('ano_publicacao', '=', $anoPublicacao );
        }
        return $query;
    }

    public function scopeFilterByValorMin($query, $valorMin)
    {
        if (!empty($valorMin)) {
            $query->whereRaw("CAST(REPLACE(REPLACE(REPLACE(valor_formatado, 'R$', ''), '.', ''), ',', '.') AS DECIMAL(10,2)) >= ?", [
                floatval($valorMin)
            ]);
        }
        return $query;
    }

    public function scopeFilterByValorMax($query, $valorMax)
    {
        if (!empty($valorMax)) {
            $query->whereRaw("CAST(REPLACE(REPLACE(REPLACE(valor_formatado, 'R$', ''), '.', ''), ',', '.') AS DECIMAL(10,2)) <= ?", [
                floatval($valorMax)
            ]);
        }
        return $query;
    }

}
