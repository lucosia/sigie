<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table="curso";
    protected $fillable=['id','nome','duracao','instituicao_id','status'];
    public $timestamps = false;

    public function alunos()
    {
        return $this->hasMany('App\Model\Aluno');
    }
}
