<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

  protected $table = "roles";
  protected $fillable = ['nombre', 'descripcion'];

  //PARA ESTABLECER LA RELACION CON LOS USUARIOS
  public function users(){
    return $this->hasMany('App\User');
  }

}
