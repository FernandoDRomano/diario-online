<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\User;
use App\Role;
use App\Http\Requests\CrearEmpleadoRequest;
use App\Http\Requests\EditarEmpleadoRequest;


class ControladorEmpleados extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //VALIDO QUE EL REQUEST TENGA ALGO PARA BUSCAR
        if ($request->buscar == null) {
          $empleados = Empleado::orderBy('id', 'ASC')->paginate(5);
        }else {
          $empleados = Empleado::buscador($request->buscar)->orderBy('id', 'ASC')->paginate(5);
        }

        //REDIRECCIONO
        return view('empleados.index')
          ->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //BUSCO LOS ROLES PARA PASARLE A LA VISTA
        //UTILIZO EL METODO pluck PARA TRAER EN FORMA DE LISTA Y CARGARLOS EN EL SELECT
        $roles = Role::orderBy('nombre', 'ASC')->pluck('nombre','id');
        //RETORNO LA VISTA CON LOS ROLES
        return view('empleados.crear')
          ->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearEmpleadoRequest $request)
    {
        //PRIMERO CREO UN OBJETO DEL TIPO USER
        $user = new User();
        //SETE LOS VALORES DEL USUARIO
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //LE ASIGNO EL ID DEL ROLE SELECCIONADO
        $user->role_id = $request->role_id;
        //GRABO EL USUARIO
        $user->save();

        //SEGUNDO CREO UN OBJETO DEL TIPO EMPLEADO
        $empleado = new Empleado();
        $empleado->apellido = $request->apellido;
        $empleado->nombre = $request->nombre;
        $empleado->fechaNacimiento = $request->fechaNacimiento;
        $empleado->dni = $request->dni;
        //POR DEFECTO EL EMPLEADO ACTIVO
        $empleado->estado = true;
        //TRATAMIENDO DE LA FOTO
        if ($request->file('foto')) {
          $file = $request->file('foto');
          //2) LE ASIGNO UN NOMBRE UNICO EN EL SISTEMA A LA IMAGEN
          $nombre = 'diario_online_' . time() . '.' . $file->getClientOriginalExtension();
          //3) CREO LA DIRECCION EN DONDE SE ALMACENARA LA IMAGEN
          $path = public_path() . '/imagenes/empleados/';
          //4) MUEVO LA IMAGEN
          $file->move($path, $nombre);
          //LE SETEO LA IMAGEN AL EMPLEADO
          $empleado->foto = $nombre;
        }else{
          $empleado->foto = "No Tiene";
        }

        //LE ASIGNO AL EMPLEADO SU USUARIO RECIEN CREADO
        $empleado->user()->associate($user);
        //GRABO EL EMPLEADO
        $empleado->save();

        //REDIRECCIONO
        if ($empleado->save()) {
          flash('¡Se ha Registrado el Empleado ' . $empleado->apellido . ', ' . $empleado->nombre . ' de Forma Exitosa!')->success()->important();
          return redirect()->action('ControladorEmpleados@index');
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
       //BUSCO EL EMPLEADO PARA PASARLO A LA VISTA
       $empleado = Empleado::find($id);
       //REDIRECCIONO
       return view('empleados.detalles')
        ->with('empleado', $empleado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //BUSCO EL EMPLEADO A EDITAR
      $empleado = Empleado::find($id);
      //BUSCO LOS ROLES
      $roles = Role::orderBy('nombre','ASC')->pluck('nombre','id');
      //REDIRECCIONO
        return view('empleados.editar')
          ->with('empleado', $empleado)
          ->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarEmpleadoRequest $request, $id)
    {
        //BUSCO EL EMPLEADO A EDITAR
        $empleado = Empleado::find($id);
        //SETEO SUS VALORES
        $empleado->apellido = $request->apellido;
        $empleado->nombre = $request->nombre;
        $empleado->dni = $request->dni;
        $empleado->fechaNacimiento = $request->fechaNacimiento;
        //TRATAMIENTO DE LA IMAGEN
        if ($request->file('foto')) {
          $file = $request->file('foto');
          //2) LE ASIGNO UN NOMBRE UNICO EN EL SISTEMA A LA IMAGEN
          $nombre = 'diario_online_' . time() . '.' . $file->getClientOriginalExtension();
          //3) CREO LA DIRECCION EN DONDE SE ALMACENARA LA IMAGEN
          $path = public_path() . '/imagenes/empleados/';
          //4) MUEVO LA IMAGEN
          $file->move($path, $nombre);
          //LE SETEO LA IMAGEN AL EMPLEADO
          $empleado->foto = $nombre;
        }else{
          $empleado->foto = $empleado->foto;
        }

        //GRABO EL EMPLEADO
        $empleado->save();

        //BUSCO EL USUARIO PARA MODIFICARLE EL CORREO Y EL ROLE
        $user = User::find($empleado->user_id);
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        //GRABO EL USUARIO
        $user->save();

        //REDIRECCIONO
        flash('¡Se ha Editado el Empleado ' . $empleado->apellido . ', ' . $empleado->nombre . ' de Forma Exitosa!')->warning()->important();
        return redirect()->action('ControladorEmpleados@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //BUSCO EL EMPLEADO A ELIMINAR
        $empleado = Empleado::find($id);
        if ($empleado->noticias()->count() == 0) {
          //GUARDO EL NOMBRE PARA MOSTRARLO EN EL MSJ FLASH
          $nombre = $empleado->apellido . ', ' . $empleado->nombre;
          //GUARDO EL ID DEL USUARIO A ELIMINAR LUEGO
          $user_id = $empleado->user_id;
          //ELIMINO EL EMPLEADO
          $empleado->delete();

          //BUSCO EL USUARIO A ELIMINAR
          $user = User::find($user_id);
          //ELIMINO EL USUARIO
          $user->delete();

          //REDIRECCIONO
          flash('¡Se ha Eliminado el Empleado ' . $nombre . ' de Forma Exitosa!')->error()->important();
          return redirect()->action('ControladorEmpleados@index');
        }else{
          return view('empleados.error')
            ->with('empleado', $empleado);
        }

    }

    public function eliminar($id){
      //BUSCO EL EMPLEADO A ELIMINAR
      $empleado = Empleado::find($id);
      //GUARDO EL NOMBRE PARA MOSTRARLO EN EL MSJ FLASH
      $nombre = $empleado->apellido . ', ' . $empleado->nombre;
      //GUARDO EL ID DEL USUARIO A ELIMINAR LUEGO
      $user_id = $empleado->user_id;
      //ELIMINO EL EMPLEADO
      $empleado->delete();

      //BUSCO EL USUARIO A ELIMINAR
      $user = User::find($user_id);
      //ELIMINO EL USUARIO
      $user->delete();

      //REDIRECCIONO
      flash('¡Se ha Eliminado el Empleado ' . $nombre . ' de Forma Exitosa!')->error()->important();
      return redirect()->action('ControladorEmpleados@index');
    }

}
