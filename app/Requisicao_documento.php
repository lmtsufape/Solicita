<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisicao_documento extends Model
{
    //
    protected $fillable = ['aluno_id','documento_id','anotacoes','status','status_data','detalhes'];
}