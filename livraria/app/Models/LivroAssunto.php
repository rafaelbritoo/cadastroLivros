<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LivroAssunto extends Model
{
    use HasFactory, Notifiable;

    //Tabela do banco responsavel para tabela de ligaçao livro com assunto
    protected $table = 'Livro_Assunto';

    // Desabilitar o uso dos campos created_at e updated_at
    public $timestamps = false;

    // Definir que essa tabela não possui chave primária padrão
    public $incrementing = false;

    // Desabilitar a chave primária
    public $primaryKey = null;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'livro_cod',   // FK para a tabela Livro
        'assunto_codAs', // FK para a tabela Aassunto
    ];

    // Relacionamento com a tabela Livro
    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_cod', 'codl');
    }

    // Relacionamento com a tabela Assunto
    public function autor()
    {
        return $this->belongsTo(Assunto::class, 'assunto_codAs', 'codAs');
    }
}
