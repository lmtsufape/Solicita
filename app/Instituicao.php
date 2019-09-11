<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    //
    protected $fillable = ['nome'];



    public function administrador(){

        return $this->belongsTo('App\Administrador');
        
    }

    public function unidade(){

        return $this->hasMany('App\Unidade');
    }

    
}
