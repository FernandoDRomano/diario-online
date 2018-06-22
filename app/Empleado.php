<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

  protected $table = "empleados";
  protected $fillable = ['apellido', 'nombre', 'fechaNacimiento', 'dni', 'estado' , 'foto', 'user_id'];

  //PARA ESTABLECER LA RELACION CON LAS NOTICIAS
  public function noticias(){
    return $this->hasMany('App\Noticia');
  }

  //PARA ESTABLECER LA RELACION CON EL USUARIO
  public function user(){
    return $this->belongsTo('App\User');
  }

  //PARA REALIZAR LA BUSQUEDA POR EL NOMBRE
  public function scopeBuscador($query, $buscar){
      return $query->where('apellido', 'LIKE', '%' . $buscar . '%')
                   ->orwhere('nombre' , 'LIKE' , '%' . $buscar . '%')
                   ->orwhere('dni' , $buscar)
                   ->orwhere('id' , $buscar);
  }

}
