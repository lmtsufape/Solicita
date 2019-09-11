<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisicao_documento extends Model
{
    //
    protected $fillable = ['anotacoes','status','status_data','detalhes'];

    public function requisicao(){
        return $this->belongsTo('App\Requisicao');
    }
    public function documento(){
        return $this->hasMany('App\Documento');
    }
}
