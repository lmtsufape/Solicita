<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    //
    protected $fillable = ['cpf'];

    public function perfil(){
        return $this->hasMany('App\Perfil');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function requisicao_documento(){
        return $this->hasMany('App\Requisicao_documento');
    }

}
