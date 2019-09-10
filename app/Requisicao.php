<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
    //
    protected $fillable = ['aluno_id','data_pedido','hora_pedido'];
}
