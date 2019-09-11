<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    //
    protected $fillable = ['nome'];


    public function instituicao(){
        return $this->belongsTo('App\Instituicao');
    }

    public function servidor(){
        return $this->hasMany('App\Servidor');
    }

    public function curso(){
        return $this->hasMany('App\Curso');
    }

}
