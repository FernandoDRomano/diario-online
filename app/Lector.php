<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lector extends Model
{

  protected $table = "lectores";
  protected $fillable = ['nombreApellido', 'fechaNacimiento', 'estado', 'user_id'];

  //PARA ESTABLECER LA RELACION CON LOS COMENTARIOS
  public function comentarios(){
    return $this->hasMany('App\Comentario');
  }

  //PARA ESTABLECER LA RELACION CON EL USUARIO
  public function user(){
    return $this->belongsTo('App\User');
  }

  //PARA REALIZAR LA BUSQUEDA DE LECTORES
  public function scopeBuscador($query, $buscar){
    return $query->where('nombreApellido', 'LIKE', '%' . $buscar . '%');
  }

}
