<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;
use App\Noticia;
use Carbon\Carbon;

class ControladorComentarios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //BUSCO LOS COMENTARIOS PARA RETORNARLOS A LA VISTA
        $comentarios = Comentario::orderBy('id', 'DESC')->paginate(5);
        //RETORNO A LA VISTA
        return view('comentarios.index')
          ->with('comentarios', $comentarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //PRIMERO CREO EL OBJETO TIPO COMENTARIO
        //EL NOTICIA_ID LO PASO EN EL REQUEST
        $comentario = new Comentario();
        //SETEO LOS VALORES
        $comentario->mensaje = $request->mensaje;
        //TRATAMIENTO DE LA FECHA ACTUAL
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $comentario->fecha = $date;
        //LE PASO EL USUARIO Y LA NOTICIA
        $comentario->noticia_id = $request->noticia_id;
        $comentario->lector_id = \Auth::user()->lector->id;

        $comentario->save();

        //REDIRECCIONO, A LA MISMA NOTICIA
        return redirect()->action('ControladorFrontend@verNoticia', $comentario->noticia_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //BUSCO LA NOTICIA CON EL COMENTARIO
      $noticia = Noticia::find($id);
      //REDIRECCIONO HACIA LA NOTICIA
      return redirect()->action('ControladorFrontend@verNoticia', $noticia->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //BUSCO EL COMENTARIO
        $comentario = Comentario::find($id);
        //GUARDO EL ID DE LA NOTICIA PARA RETORNARLO LUEGO A LA VISTA
        $id = $comentario->noticia_id;
        //ELIMINO EL COMENTARIO
        $comentario->delete();

        //REDIRECCIONO
        flash('¡Se ha Eliminado el Comentario ' . $id . ' de Forma Exitosa!')->error()->important();
        return redirect()->action('ControladorFrontend@verNoticia', $id);
    }

}
