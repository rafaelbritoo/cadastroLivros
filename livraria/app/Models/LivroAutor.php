<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class LivroAutor extends Model
{
    use HasFactory, Notifiable;

    //Tabela do banco responsavel por ligar livro a autor
    protected $table = 'Livro_Autor';

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
        'autor_codAu', // FK para a tabela Autor
    ];

    // Relacionamento com a tabela Livro
    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_cod', 'codl');
    }

    // Relacionamento com a tabela Autor
    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_codAu', 'codAu');
    }

}
