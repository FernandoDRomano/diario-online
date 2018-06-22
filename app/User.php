<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //PARA ESTABLECER LA RELACION CON EL ROLE
    public function role(){
      return $this->belongsTo('App\Role');
    }

    //PARA ESTABLECER LA RELACION CON EL EMPLEADO
    public function empleado(){
      return $this->hasOne('App\Empleado');
    }

    //PARA ESTABLECER LA RELACION CON EL LECTOR
    public function lector(){
      return $this->hasOne('App\Lector');
    }

}
