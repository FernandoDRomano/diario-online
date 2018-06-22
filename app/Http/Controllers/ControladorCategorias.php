<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Http\Requests\CategoriaRequest;

class ControladorCategorias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if ($request->buscar == null) {
        $categorias = Categoria::orderBy('id', 'ASC')->paginate(5);
      }else{
        $categorias = Categoria::search($request->buscar)->orderBy('id', 'ASC')->paginate(5);
      }

      return view('categorias.index')->with('categorias', $categorias);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        //INSTANCIO EL OBJETO DE LA CATEGORIA
        $categoria = new Categoria();
        //SETEO LOS VALORES DEL OBJETO CON LOS VALORES DEL FORMULARIO
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        //GRABO
        $categoria->save();

        //REDIRECCIONO AL INDEX DE LAS CATEGORIAS
        if ($categoria->save()) {
          //MENSAJE FLASH
          flash('¡Se ha Registrado la Categoria ' . $categoria->nombre . ' de Forma Exitosa!')->success()->important();
          return redirect()->action('ControladorCategorias@index');
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
        //BUSCO LA CATEGORIA POR EL ID, Y LE ASIGNO A UN OBJETO
        $categoria = Categoria::find($id);
        //RETORNO LA VISTA CON EL FORMULARIO PARA EDITAR
        return view('categorias.editar')
          ->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        //BUSCO LA CATEGORIA POR EL ID, PARA LUEGO SETEARLE LOS VALORES
        $categoria = Categoria::find($id);
        //SETEO LOS VALORES CON LOS DEL FORMULARIO
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        //GUARDO LA CATEGORIA CON LOS NUEVOS VALORES
        $categoria->save();

        //SI SE GUARDO BIEN REDIRECCIONO EL INDEX DE LA CATEGORIAS
        if ($categoria->save()) {
          flash('¡Se ha Editado la Categoria ' . $categoria->nombre . ' de Forma Exitosa!')->warning()->important();
          return redirect()->action('ControladorCategorias@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //BUSCO LA CATEGORIA A ELIMINAR
      $categoria = Categoria::find($id);
      //VALIDO QUE NO TENGA NOTICIAS
      if ($categoria->noticias()->count() == 0) {
        //GUARDO EL NOMBRE PARA MOSTRARLO EN UN MSJ DEL TIPO FLASH
        $name = $categoria->nombre;
        //ELIMINO LA CATEGORIA
        $categoria->delete();

        flash('¡Se ha Eliminado la Categoria ' . $name . ' de Forma Exitosa!')->error()->important();
        return redirect()->action('ControladorCategorias@index');
      }else{
        return view('categorias.error')
          ->with('categoria', $categoria);
      }

    }

    public function eliminar($id){
      //BUSCO LA CATEGORIA A ELIMINAR
      $categoria = Categoria::find($id);
      //GUARDO EL NOMBRE PARA MOSTRARLO EN UN MSJ DEL TIPO FLASH
      $name = $categoria->nombre;
      //ELIMINO LA CATEGORIA
      $categoria->delete();

      flash('¡Se ha Eliminado la Categoria ' . $name . ' de Forma Exitosa!')->error()->important();
      return redirect()->action('ControladorCategorias@index');
    }

}
