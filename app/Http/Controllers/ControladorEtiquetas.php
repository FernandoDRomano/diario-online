<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etiqueta;
use App\Http\Requests\EtiquetaRequest;

class ControladorEtiquetas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //VALIDO SI EL REQUEST TIENE ALGO PARA BUSCAR
        if ($request->buscar == null) {
          $etiquetas = Etiqueta::orderBy('id', 'ASC')->paginate(5);
        }else{
          $etiquetas = Etiqueta::buscador($request->buscar)->orderBy('id', 'ASC')->paginate(5);
        }

        //RETORNO A LA VISTA LAS ETIQUETAS
        return view('etiquetas.index')
          ->with('etiquetas', $etiquetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //RETORNO LA VISTA CON EL FORMULARIO PARA CREAR LA ETIQUETA
        return view('etiquetas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EtiquetaRequest $request)
    {
        //INSTANCIO UN OBJETO DEL TIPO ETIQUETA
        $etiqueta = new Etiqueta();
        //SETEO LOS VALORES DEL OBJETO
        $etiqueta->nombre = $request->nombre;
        //GRABO
        $etiqueta->save();

        //REDIRECCIONO
        if ($etiqueta->save()) {
          flash('¡Se ha Registrado la Etiqueta ' . $etiqueta->nombre . ' de Forma Exitosa!')->success()->important();
          return redirect()->action('ControladorEtiquetas@index');
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
        //BUSCO LA ETIQUETA Y LA RETORNO CON LA VISTA PARA SU EDICION
        $etiqueta = Etiqueta::find($id);
        return view('etiquetas.editar')
          ->with('etiqueta', $etiqueta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EtiquetaRequest $request, $id)
    {
        //BUSCO LA ETIQUETA A LA QUE VOY A SETEARLE LOS VALORES CON LOS DEL FORMULARIO
        $etiqueta = Etiqueta::find($id);
        //SETEO LOS VALORES
        $etiqueta->nombre = $request->nombre;
        //GRABO
        $etiqueta->save();

        //REDIRECCIONO
        if ($etiqueta->save()) {
          flash('¡Se ha Editado la Etiqueta ' . $etiqueta->nombre . ' de Forma Exitosa!')->warning()->important();
          return redirect()->action('ControladorEtiquetas@index');
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
        //BUSCO LA ETIQUETA A ELIMINAR
        $etiqueta = Etiqueta::find($id);
        if ($etiqueta->noticias()->count() == 0) {
          //GUARDO EL NOMBRE PARA MOSTRARLO EN EL MSJ FLASH
          $nombre = $etiqueta->nombre;
          //ELIMINO
          $etiqueta->delete();
          //REDIRECCIONO
          flash('¡Se ha Eliminado la Etiqueta ' . $nombre . ' de Forma Exitosa!')->error()->important();
          return redirect()->action('ControladorEtiquetas@index');
        }else{
          return view('etiquetas.error')
            ->with('etiqueta', $etiqueta);
        }

    }

    public function eliminar($id){
      //BUSCO LA ETIQUETA A ELIMINAR
      $etiqueta = Etiqueta::find($id);
      //GUARDO EL NOMBRE PARA MOSTRARLO EN EL MSJ FLASH
      $nombre = $etiqueta->nombre;
      //ELIMINO
      $etiqueta->delete();
      //REDIRECCIONO
      flash('¡Se ha Eliminado la Etiqueta ' . $nombre . ' de Forma Exitosa!')->error()->important();
      return redirect()->action('ControladorEtiquetas@index');
    }

}
