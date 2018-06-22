<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{

  protected $table = "etiquetas";
  protected $fillable = ['nombre'];

  //PARA ESTABLECER LA RELACION CON LOS ARTICULOS
  public function noticias(){
    return $this->belongsToMany('App\Noticia');
  }

  public function scopeBuscador($query, $buscar){
    return $query->where('nombre', 'LIKE', '%' . $buscar . '%');
  }

}
