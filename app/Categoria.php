<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

  protected $table = "categorias";
  protected $fillable = ['nombre', 'descripcion'];

  //PARA ESTABLECER LA RELACION CON LAS NOTICIAS
  public function noticias(){
    return $this->hasMany('App\Noticia');
  }

  //PARA EL BUSCADOR USARE UN SCOPE
  public function scopeSearch($query, $buscar){
    return $query->where('nombre', 'LIKE' , '%'. $buscar . '%')
                 ->orwhere('descripcion', 'LIKE', '%' . $buscar . '%')
                 ->orwhere('id' , $buscar);
  }

}
