<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Autor extends Model
{
    use HasFactory, Notifiable;

    //Tabela do banco responsavel por manter autor
    protected $table = 'Autor';

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
}
