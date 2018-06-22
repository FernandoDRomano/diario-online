<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{

  protected $table = "imagenes";
  protected $fillable = ['nombre', 'noticia_id'];

  //PARA ESTABLECER LA RELACION CON LA NOTICIA
  public function noticia(){
    return $this->belongsTo('App\Noticia');
  }
  
}
