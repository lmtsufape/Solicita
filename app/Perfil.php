<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    protected $fillable = ['aluno_id', 'unidade_id','curso_id', 'default','situacao'];
}
