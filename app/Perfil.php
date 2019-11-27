<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use SoftDeletes;

class Perfil extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['default','situacao', 'valor', 'aluno_id', 'unidade_id', 'curso_id'];
    protected $dates = ['deleted_at'];

    public function requisicao(){
        return $this->hasMany('App\Requisicao');
    }

    public function aluno(){
        return $this->belongsTo('App\Aluno');
    }

    public function curso(){
        return $this->belongsTo('App\Curso');
    }

}
