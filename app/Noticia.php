<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{

  protected $table = "noticias";
  protected $fillable = ['titulo', 'subTitulo', 'contenido', 'fecha', 'categoria_id', 'empleado_id'];

  //PARA ESTABLECER LA RELACION CON LA CATEGORIA
  public function categoria(){
    return $this->belongsTo('App\Categoria');
  }

  //PARA ESTABLECER LA RELACION CON EL EMPLEADO
  public function empleado(){
    return $this->belongsTo('App\Empleado');
  }

  //PARA ESTABLECER LA RELACION CON LAS IMAGENES
  public function imagenes(){
    return $this->hasMany('App\Imagen');
  }

  //PARA ESTABLECER LA RELACION CON LOS COMENTARIOS
  public function comentarios(){
    return $this->hasMany('App\Comentario');
  }

  //PARA ESTABLECER LA RELACION CON LAS ETIQUETAS
  public function etiquetas(){
    return $this->belongsToMany('App\Etiqueta');
  }

  public function scopeBuscador($query, $buscar){
    return $query->where('titulo' , 'LIKE' , '%' . $buscar . '%');
  }

}
