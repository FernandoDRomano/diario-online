<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

  protected $table = "comentarios";
  protected $fillable = ['mensaje', 'fecha', 'noticia_id', 'lector_id'];

  //PARA ESTABLECER LA RELACION CON LA NOTICIA
  public function noticia(){
    return $this->belongsTo('App\Noticia');
  }

  //PARA ESTABLECER LA RELACION CON EL LECTOR
  public function lector(){
    return $this->belongsTo('App\Lector');
  }

}
