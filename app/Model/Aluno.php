<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table="aluno";
    protected $fillable=['id','nome','cpf','data_de_nascimento','celular','endereco','numero','bairro','cidade','uf','instituicao_id','curso_id','status'];

    public $timestamps = false;

    public function curso()
    {
        return $this->belongsTo('App\Model\Curso');
    }
}
