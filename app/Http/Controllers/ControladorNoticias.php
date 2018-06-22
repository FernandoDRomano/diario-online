<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
use App\Categoria;
use App\Etiqueta;
use App\Imagen;
use App\Empleado;
use Carbon\Carbon;
use App\Http\Requests\NoticiaRequest;

class ControladorNoticias extends Controller
{

    public function __construct(){
      Carbon::setLocale('es');
    }

    public function index(Request $request)
    {
        //VALIDO QUE EL BUSCADOR NO TENGA NADA PARA BUSCAR
        if ($request->buscar == null) {
          $noticias = Noticia::orderBy('id', 'DESC')->paginate(5);
        }else{
          $noticias = Noticia::buscador($request->buscar)->orderBy('id', 'DESC')->paginate(5);
        }
        //REDIRECCIONO
        return view('noticias.index')
          ->with('noticias', $noticias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //BUSCO LAS CATEGORIAS Y LAS ETIQUETAS PARA ENVIAR A LA VISTA
        $categorias = Categoria::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $etiquetas = Etiqueta::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        //RETORNO A LA VISTA
        return view('noticias.crear')
          ->with('categorias', $categorias)
          ->with('etiquetas', $etiquetas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiaRequest $request)
    {
      //CREO UN OBJETO DEL TIPO NOTICIA
      $noticia = new Noticia();
      //SETEO SUS VALORES
      $noticia->titulo = $request->titulo;
      $noticia->subTitulo = $request->subTitulo;
      $noticia->contenido = $request->contenido;
      //TRATAMIENTO DE LA FECHA ACTUAL
      $date = Carbon::now();
      $date = $date->format('Y-m-d');
      $noticia->fecha = $date;
      //LE ASIGNO LA CATEGORIA Y EL EMPLEADO
      $noticia->categoria_id = $request->categoria_id;
      $noticia->empleado_id = \Auth::user()->empleado->id;
      //GRABO LA NOTICIA
      $noticia->save();

      //POR ULTIMO ME ENCARGO DE LLENAR LA TABLA etiqueta_noticia, UTILIZANDO EL METODO DEL MODELO noticia->etiquetas()
      //Y LA FUNCION sync(), QUE RECIBE COMO PARAMETRO LAS ETIQUETAS SELECCIONADOS EN LA VISTA
      $noticia->etiquetas()->sync($request->etiquetas);

      //MANIPULACION DE LAS IMAGENES
      $x = 0;
      if ($request->file('imagenes')) {
        foreach ($request->file('imagenes') as $r) {
          $file = $r;
          //2) LE ASIGNO UN NOMBRE UNICO EN EL SISTEMA A LA IMAGEN
          $nombre = 'diario_online'. $x . '_' . time() . '.' . $file->getClientOriginalExtension();
          //3) CREO LA DIRECCION EN DONDE SE ALMACENARA LA IMAGEN
          $path = public_path() . '/imagenes/noticias/';
          //4) MUEVO LA IMAGEN
          $file->move($path, $nombre);
          //CONTINUO GUARDANDO LAS IMAGENES
          $imagen = new Imagen();
          $imagen->nombre = $nombre;
          //SETEO EL VALOR noticia_id, UTILIZANDO EL METODO DEL MODELO noticia() Y LA FUNCION ASSOCIATE
          $imagen->noticia()->associate($noticia);
          //GUARDO LA IMAGEN
          $imagen->save();
          $x = $x + 1;
        }
      }

      //REDIRECCIONO
      flash('¡Se ha Registrado la Noticia ' . $noticia->titulo . ' de Forma Exitosa!')->success()->important();
      return redirect()->action('ControladorNoticias@index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //BUSCO LA NOTICIA A MOSTRAR
        $noticia = Noticia::find($id);
        //CREO UNA VARIABLE PARA PODER OBTENER LAS ETIQUETAS DE LA NOTICIA Y OBTENERLOS EN FORMA DE ARRAY (POR SU CAMPO ID)
        $mi_etiquetas = $noticia->etiquetas->pluck('nombre','id')->toArray();
        //REDIRECCIONO
        return view('noticias.detalles')
          ->with('noticia',$noticia)
          ->with('mi_etiquetas', $mi_etiquetas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //BUSCO LA NOTICIA A EDITAR
        $noticia = Noticia::find($id);
        //BUSCO LAS CATEGORIAS Y LAS ETIQUETAS PARA MANDARLAS A LA VISTA
        $categorias = Categoria::orderBy('nombre', 'ASC')->pluck('nombre', 'id');
        $etiquetas = Etiqueta::orderBy('nombre', 'ASC')->pluck('nombre', 'id');

        //CREO UNA VARIABLE PARA PODER OBTENER LAS ETIQUETAS DE LA NOTICIA Y OBTENERLOS EN FORMA DE ARRAY (POR SU CAMPO ID)
        $mi_etiquetas = $noticia->etiquetas->pluck('id')->ToArray();

        //REDIRECCIONO
        return view('noticias.editar')
          ->with('noticia', $noticia)
          ->with('categorias', $categorias)
          ->with('etiquetas', $etiquetas)
          ->with('mi_etiquetas', $mi_etiquetas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticiaRequest $request, $id)
    {
        //BUSCO LA NOTICIA A EDITAR
        $noticia = Noticia::find($id);
        //SETEO LOS VALORES
        $noticia->titulo = $request->titulo;
        $noticia->subTitulo = $request->subTitulo;
        $noticia->contenido = $request->contenido;
        $noticia->categoria_id = $request->categoria_id;
        //GRABO
        $noticia->save();

        //LLENO LA TABLA DE LAS ETIQUETAS
        $noticia->etiquetas()->sync($request->etiquetas);

        //REDIRECCIONO
        flash('¡Se ha Editado la Noticia ' . $noticia->titulo . ' de Forma Exitosa!')->warning()->important();;
        return redirect()->action('ControladorNoticias@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //BUSCO LA NOTICIA A ELIMINAR
        $noticia = Noticia::find($id);
        $nombre = $noticia->titulo;
        //ELIMINO
        $noticia->delete();

        //REDIRECCIONO
        flash('¡Se ha Eliminado la Noticia ' . $nombre . ' de Forma Exitosa!')->error()->important();
        return redirect()->action('ControladorNoticias@index');
    }
}
