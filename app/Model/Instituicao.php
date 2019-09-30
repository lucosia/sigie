<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table="instituicao";
    protected $fillable=['id','nome','cnpj','status'];

    public $timestamps = false;

}
