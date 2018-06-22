<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lector;
use App\User;
use Carbon\Carbon;

use App\Http\Requests\CrearLectorRequest;

class ControladorLectores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //VALIDO QUE TENGA ALGO PARA BUSCAR EL REQUEST
        if ($request->buscar == null) {
          $lectores = Lector::orderBy('id', 'ASC')->paginate(5);
        }else{
          $lectores = Lector::buscador($request->buscar)->orderBy('id', 'ASC')->paginate(5);
        }
        //RETORNO LA VISTA CON LOS LECTORES
        return view('lectores.index')
          ->with('lectores', $lectores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //RETORNO LA VISTA CON EL FORMULARIO PARA QUE SE REGISTRE EL LECTOR
        return view('lectores.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearLectorRequest $request)
    {

        //CREO EL OBJETO DEL TIPO USUARIO PRIMERO
        $user = new User();
        //SETEO LOS VALORES DEL USUARIO
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //LE ASIGNO EL ROLE DE MIEMBRO (ID = 4)
        $user->role_id = 4;
        //GRABO EL USUARIO
        $user->save();

        //UNA VES CREADO EL USUARIO CREO EL OBJETO DEL TIPO LECTOR
        $lector = new Lector();
        //SETEO SUS VALORES
        $lector->nombreApellido = $request->nombreApellido;
        $lector->fechaNacimiento = $request->fechaNacimiento;
        //PONGO EL ESTADO DEL LECTOR COMO TRUE
        $lector->estado = true;
        //SETEO EL VALOR user_id, UTILIZANDO EL METODO DEL MODELO user() Y LA FUNCION ASSOCIATE
        $lector->user()->associate($user);
        //GRABO EL LECTOR
        $lector->save();

        //REDIRECCIONO
        if ($lector->save()) {
          return view('lectores.confirmacionCrear');
        }


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //BUSCO EL LECTOR A ELIMINAR
        $lector = Lector::find($id);
        $nombre = $lector->nombreApellido;
        $user_id = $lector->user_id;
        //ELIMINO EL LECTOR
        $lector->delete();

        //BUSCO EL USUARIO A ELIMINAR
        $user = User::find($user_id);
        //ELIMINO EL USUARIO
        $user->delete();

        //REDIRECCIONO
        flash('¡Se ha Eliminado el Lector ' . $nombre . ' de Forma Exitosa!')->error()->important();
        return redirect()->action('ControladorLectores@index');
    }
}
