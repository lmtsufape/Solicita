<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    //
    protected $fillable = ['administrador_id','nome'];

    public function administrador(){

        return $this->belongsTo('App\Administrador');
        
    }
    
}
