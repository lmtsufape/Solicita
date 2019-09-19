<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
   //
   protected $fillable = ['matricula'];

   public function requisicao(){
      return $this->hasMany('App\Requisicao');
   }

   public function unidade(){
      return $this->belongsTo('App\Unidade');
   }

   public function user(){
      return $this->belongsTo('App\User');
   }
}
