<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Livro extends Model
{
    use HasFactory, Notifiable;

    //Tabela do banco responsavel por manter Livro
    protected $table = 'Livro';

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
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'livro_cod', 'autor_codAu');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'livro_cod', 'assunto_codAs');
    }

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'codAu');
    }

    public function assunto()
    {
        return $this->belongsTo(Assunto::class, 'codAs');
    }
}
