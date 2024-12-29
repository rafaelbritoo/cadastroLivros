<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Assunto extends Model
{
    use HasFactory, Notifiable;

    //Tabela do banco responsavel por manter assunto
    protected $table = 'assunto';

    // Desabilitar o uso dos campos created_at e updated_at
    public $timestamps = false;

    // Definir a chave primária, já que não é 'id'
    protected $primaryKey = 'codAs';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'descricao'
    ];

    // Campos que não podem ser atualizados diretamente
    protected $guarded = ['codAs'];

    // Relacionamento muitos para muitos entre Assunto e Livro
    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_Assunto', 'assunto_codAs', 'livro_codl');
    }

    // Escopo para filtrar por descrição
    public function scopeFilterByDescricao($query, $descricao)
    {
        if (!empty($descricao)) {
            return $query->where('descricao', 'like', '%' . $descricao . '%');
        }
        return $query;
    }

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        if (in_array($column, ['codAs'])) {
            return $query->orderBy($column, $direction);
        }
        return $query;
    }
}
