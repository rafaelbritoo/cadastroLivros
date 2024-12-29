<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Livro extends Model
{
    use HasFactory, Notifiable;

    //Tabela do banco responsavel por manter Livro
    protected $table = 'livro';

    // Desabilitar o uso dos campos created_at e updated_at
    public $timestamps = false;

    // Definir a chave primária, já que não é 'id'
    protected $primaryKey = 'codl';

    // Se o auto incremento for configurado corretamente no banco
    public $incrementing = true;

    // Defina o tipo da chave primária (se não for um inteiro)
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'anoPublicacao',
        'valor'
    ];

    // Campos que não podem ser atualizados diretamente
    protected $guarded = ['codl'];

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'livro_codl', 'autor_codAu');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'livro_codl', 'assunto_codAs');
    }

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'codAu');
    }

    public function assunto()
    {
        return $this->belongsTo(Assunto::class, 'codAs');
    }

    // Escopo para filtrar por título
    public function scopeFilterByTitulo($query, $titulo)
    {
        if (!empty($titulo)) {
            return $query->where('titulo', 'like', '%' . $titulo . '%');
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
            return $query->where('anoPublicacao', '=', $anoPublicacao );
        }
        return $query;
    }

    public function scopeFilterByValorMin($query, $valorMin)
    {
        if (!empty($valorMin)) {
            return $query->where('valor', '>=', $valorMin );
        }
        return $query;
    }

    public function scopeFilterByValorMax($query, $valorMax)
    {
        if (!empty($valorMax)) {
            return $query->where('valor', '<=', $valorMax );
        }
        return $query;
    }

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        if (in_array($column, ['codl'])) {
            return $query->orderBy($column, $direction);
        }
        return $query;
    }
}
