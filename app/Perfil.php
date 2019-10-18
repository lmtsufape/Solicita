<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    protected $fillable = ['default','situacao'];


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
