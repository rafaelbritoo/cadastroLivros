<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
}
