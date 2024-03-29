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

Route::get('/main', function () {
    return view('contenido/contenido');
})->name('main');

// Route::get('/nuevoreferido', 'SocioController@agregar');
// Route::get('/puntos', 'TransaccionController@viewPuntos');
// Route::get('/listatransacciones', 'TransaccionController@lista');
// Route::get('/listasocios','SocioController@lista');
// Route::get('/equipo/{idSocios}', 'SocioController@equipo');
// Route::post('/equipo/{idSocios}', 'SocioController@team');

// Route::post('/nuevoreferido','SocioController@store');
// Route::post('/puntos', 'TransaccionController@asignapuntos') ;
// Route::get('/actualizareferido/{idSocios}','SocioController@actualizar');
// Route::post('/actualizareferido/{idSocios}','SocioController@update');

Route::get('/generos','GeneroController@index');
Route::post('generos/registrar', 'GeneroController@store');
Route::put('generos/actualizar','GeneroController@update');
Route::get('/generos/selectGeneros','GeneroController@selectGeneros');

Route::get('/plataformas','PlataformaController@index');
Route::post('/plataformas/registrar', 'PlataformaController@store');
Route::put('/plataformas/actualizar','PlataformaController@update');
Route::get('/plataformas/selectPlataformas','PlataformaController@selectPlataformas');


Route::get('/productos','ProductoController@index');
Route::post('/productos/registrar', 'ProductoController@store');
Route::put('/productos/actualizar','ProductoController@update');
Route::put('/productos/asociarGenero','ProductoController@asociar');


Route::get('/clientes','ClienteController@index');
Route::post('/clientes/registrar','ClienteController@store');
Route::put('/clientes/actualizar', 'ClienteController@update');
Route::get('/clientes/selectClientes','ClienteController@selectClientes');
Route::get('/clientes/transaccionClientes','ClienteController@transaccionClientes');



Route::get('/socios','SocioController@index');
Route::post('/socios/registrar','SocioController@store');
Route::put('/socios/actualizar', 'SocioController@update');

Route::get('/roles','RolController@index');
Route::get('/roles/selectRoles','RolController@selectRoles');


Route::get('/transacciones','TransaccionController@index');
Route::post('/transacciones/registrar','TransaccionController@store');
Route::put('/transacciones/actualizar', 'TransaccionController@update');



Route::get('/usuarios','UserController@index');
Route::post('/usuarios/registrar','UserController@store');


/*Route::get('/inicio', function () {
    return view('main');
});*/



Route::get('/', 'Auth\LoginController@showLoginForm')->name('/');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');




Route::get('/home', 'HomeController@index')->name('home');
