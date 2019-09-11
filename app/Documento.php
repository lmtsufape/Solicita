<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    protected $fillable = ['tipo'];

    public function requisicao_documento(){
        return $this->belongsTo('App\Requisicao_documento');
    }
}
