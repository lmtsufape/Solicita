<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    //
    protected $fillable = ['matricula'];

    public function instituicao(){
        
        return $this->hasOne('App\Instituicao');
    }
}
