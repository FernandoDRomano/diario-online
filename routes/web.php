<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
  'uses' => 'ControladorFrontend@index'
]);

//CREO EL GRUPO DE RUTAS PARA ADMINISTRAR LAS CATEGORIAS
Route::resource('categorias','ControladorCategorias')->middleware('auth');
Route::delete('categorias/eliminar/{id}' , [
  'uses' => 'ControladorCategorias@eliminar'
]);

//CREO EL GRUPOS DE RUTAS PARA LAS ETIQUETAS
Route::resource('etiquetas','ControladorEtiquetas')->middleware('auth');
Route::delete('etiquetas/eliminar/{id}' , [
  'uses' => 'ControladorEtiquetas@eliminar'
]);

//CREO EL GRUPO DE RUTAS PARA LOS LECTORES
Route::resource('lectores', 'ControladorLectores');

//CREO EL GRUPO DE RUTAS PARA TRABAJAR CON LOS EMPLEADOS
Route::resource('empleados' , 'ControladorEmpleados')->middleware('auth');
Route::delete('empleados/eliminar/{id}' , [
  'uses' => 'ControladorEmpleados@eliminar'
]);

//CREO EL GRUPO DE RUTAS PARA TRABAJAR CON LAS NOTICIAS
Route::resource('noticias' , 'ControladorNoticias')->middleware('auth');

//PARA VER LAS NOTICIAS EN EL FRONTEND
Route::get('ver/noticia/{id}', [
  'uses' => 'ControladorFrontend@verNoticia'
]);

//PARA VER LAS NOTICIAS POR CATEGORIAS
Route::get('ver/noticia/categoria/{id}', [
  'uses' => 'ControladorFrontend@verNoticiaCategoria'
]);

//PARA VER LAS NOTICIAS POR ETIQUETAS
Route::get('ver/noticia/etiqueta/{id}', [
  'uses' => 'ControladorFrontend@verNoticiaEtiqueta'
]);

//CREO EL GRUPO DE RUTAS PARA ADMINISTRAR LOS COMENTARIOS
Route::resource('comentarios','ControladorComentarios');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
