<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
use App\Etiqueta;
use App\Categoria;
use Carbon\Carbon;

class ControladorFrontend extends Controller
{

  public function __construct(){
    Carbon::setLocale('es');
  }

  public function index()
  {
    //RETORNA LA VISTA PRINCIPAL DE LA PAGINA
    $noticias = Noticia::orderBy('id', 'DESC')->paginate(10);
    $etiquetas = Etiqueta::orderBy('nombre', 'ASC')->get();
    $categorias = Categoria::orderBy('nombre', 'ASC')->get();
    return view('frontend.inicio')
      ->with('noticias', $noticias)
      ->with('etiquetas', $etiquetas)
      ->with('categorias', $categorias);
  }

  public function verNoticia($id){
    //BUSCO LA NOTICIA
    $noticia = Noticia::find($id);
    //BUSCOS LAS ETIQUETAS CORRESPONDIENTES A LA NOTICIA
    $mi_etiquetas = $noticia->etiquetas;
    //RETORNAR A LA VISTA CON LA NOTICIA
    return view('frontend.noticia')
      ->with('noticia', $noticia)
      ->with('mi_etiquetas', $mi_etiquetas);
  }

  public function verNoticiaCategoria($id){
    //BUSCO LA CATEGORIA
    $categoria = Categoria::find($id);
    //BUSCO LAS NOTICIAS POR LA CATEGORIA
    $noticias = $categoria->noticias()->orderBy('id','DESC')->paginate(10);
    //BUSCO LAS CATEGORIAS Y LAS ETIQUETAS
    $etiquetas = Etiqueta::orderBy('nombre', 'ASC')->get();
    $categorias = Categoria::orderBy('nombre', 'ASC')->get();
    //RETORNO A LA VISTA
    return view('frontend.inicio')
      ->with('noticias', $noticias)
      ->with('etiquetas', $etiquetas)
      ->with('categorias', $categorias)
      ->with('cat', $categoria);
  }

  public function verNoticiaEtiqueta($id){
    //BUSCO LA ETIQUETA
    $etiqueta = Etiqueta::find($id);
    //BUSCO LAS NOTICIAS POR LA ETIQUETA
    $noticias = $etiqueta->noticias()->orderBy('id','DESC')->paginate(10);
    //BUSCO LAS CATEGORIAS Y LAS ETIQUETAS
    $etiquetas = Etiqueta::orderBy('nombre', 'ASC')->get();
    $categorias = Categoria::orderBy('nombre', 'ASC')->get();
    //RETORNO A LA VISTA
    return view('frontend.inicio')
      ->with('noticias', $noticias)
      ->with('etiquetas', $etiquetas)
      ->with('categorias', $categorias)
      ->with('etiq', $etiqueta);
  }


}
