<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Autor extends Model
{
    use HasFactory, Notifiable;

    //Tabela do banco responsavel por manter autor
    protected $table = 'autor';

    // Desabilitar o uso dos campos created_at e updated_at
    public $timestamps = false;

    // Definir a chave primária, já que não é 'id'
    protected $primaryKey = 'codAu';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nome'
    ];

    // Campos que não podem ser atualizados diretamente
    protected $guarded = ['codAu'];

    // Relacionamento muitos para muitos entre Autor e Livro
    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_autor', 'autor_codAu', 'livro_codl');
    }

    public function scopeFilterByNome($query, $nome)
    {
        if (!empty($nome)) {
            return $query->where('nome', 'like', '%' . $nome . '%');
        }
        return $query;
    }

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        if (in_array($column, ['codAu'])) {
            return $query->orderBy($column, $direction);
        }
        return $query;
    }
}
