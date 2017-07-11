<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//*********************Rutas para administrador*********************************
Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios
	Route::get('/user', function () {return view('usuarios.loginUsuarios');});
	Route::post('/login','usuariosController@login');
});

Route::group(['middleware' => ['inside','HistoryBack']], function () {
    //Rutas internas Módulo de usuarios
   	Route::get('/', function () {return view('user.panelAdmin');});
	//Route::get('/user/panelAdmin', function () {return view('user.panelAdmin');});
	Route::get('/logout','userController@logout');
	Route::get('/user/create','userController@create');
	Route::post('/user/store','userController@store');
	Route::get('/user/listUser','userController@index');
	Route::get('/user/edit/{id}','userController@edit');
	Route::get('/user/update/{id}','userController@update');
	Route::get('/user/destroy/{id}','userController@destroy');
});
Route::get('/user/panelAdmin', function () {return view('user.panelAdmin');});

//**********************Rutas para usuarios regulares********************************
//Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
//	Route::get('/regularuser', function () {return view('regularuser.loginUser');});
//	Route::post('/login','regularuserController@login');
//});


//Rutas internas Módulo de usuarios regulares
   //	Route::get('/', function () {return view('regularuser.maininterface');});
	//Route::get('/regularuser/maininterface', function () {return view('regularuser.maininterface');});
	//Route::get('/logout','regularuserController@logout');


//**********************Rutas para Organismos********************************

Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/organismos', function () {return view('organismos.create');});
	Route::get('/organismos/create','organismosController@create');
	Route::post('/organismos/store','organismosController@store');
	Route::get('/organismos/listOrganismos','organismosController@index');
	Route::get('/organismos/edit/{id}','organismosController@edit');
	Route::put('/organismos/update/{id}','organismosController@update');
    Route::get('/organismos/organismomodal/{id}','organismosController@organismoModal');
	Route::put('/organismos/destroy/{id}','organismosController@destroy');
});

//**********************Rutas para cargos********************************

Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/dependencias', function () {return view('dependencias.create');});
	Route::get('/dependencias/create','dependenciasController@create');
	Route::post('/dependencias/store','dependenciasController@store');
	Route::get('/dependencias/listDependencias','dependenciasController@index');
	Route::get('/dependencias/edit/{id}','dependenciasController@edit');
	Route::put('/dependencias/update/{id}','dependenciasController@update');
    Route::get('/dependencias/dependenciamodal/{id}','dependenciasController@dependenciaModal');
	Route::put('/dependencias/destroy/{id}','dependenciasController@destroy');
});

//**********************Rutas para Cargos********************************
Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/cargos', function () {return view('cargos.create');});
	Route::get('/cargos/create','cargosController@create');
	Route::post('/cargos/store','cargosController@store');
	Route::get('/cargos/listCargos','cargosController@index');
	Route::get('/cargos/edit/{id}','cargosController@edit');
	Route::put('/cargos/update/{id}','cargosController@update');
    Route::get('/cargos/cargos-modal/{id}','cargosController@cargoModal');
	Route::put('/cargos/destroy/{id}','cargosController@destroy');
});


//**********************Rutas para Pie y Encabezados********************************
Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/imagenes', function () {return view('imagenes.create');});
	Route::get('/imagenes/create','imagenesController@create');
	Route::post('/imagenes/store','imagenesController@store');
	Route::get('/imagenes/listImagenes','imagenesController@index');
	Route::get('/imagenes/edit/{id}','imagenesController@edit');
	Route::put('/imagenes/update/{id}','imagenesController@update');
    Route::get('/imagenes/imagenes-modal/{id}','imagenesController@cargoModal');
	Route::put('/imagenes/destroy/{id}','imagenesController@destroy');
});

//**********************Rutas para Usuarios********************************

Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/usuarios', function () {return view('usuarios.create');});
	Route::get('/logout','usuariosController@logout');
	Route::get('/usuarios/create','usuariosController@create');
	Route::post('/usuarios/store','usuariosController@store');
	Route::get('/usuarios/listUsuarios','usuariosController@index');
	Route::get('/usuarios/edit/{id}','usuariosController@edit');
	Route::put('/usuarios/update/{id}','usuariosController@update');
    Route::get('/usuarios/usuarios-modal/{id}','usuariosController@usuarioModal');
	Route::put('/usuarios/destroy/{id}','usuariosController@destroy');
	Route::get('/usuarios/orgbydep/{id}','usuariosController@orgbydep');
	Route::get('/usuarios/updatepasswd/{id}','usuariosController@updatepasswd');
});
//**********************Rutas para Direcciones********************************

Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/direcciones', function () {return view('direcciones.create');});
	Route::get('/direcciones/create','direccionController@create');
	Route::post('/direcciones/store','direccionController@store');
	Route::get('/direcciones/listDirecciones','direccionController@index');
	Route::get('/direcciones/edit/{id}','direccionController@edit');
	Route::put('/direcciones/update/{id}','direccionController@update');
    Route::get('/direcciones/direcciones-modal/{id}','direccionController@direccionModal');
	Route::put('/direcciones/destroy/{id}','direccionController@destroy');

});

//**********************Rutas para Divisiones********************************

Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/divisiones', function () {return view('direcciones.create');});
	Route::get('/divisiones/create','divisionController@create');
	Route::post('/divisiones/store','divisionController@store');
	Route::get('/divisiones/listDivisiones','divisionController@index');
	Route::get('/divisiones/edit/{id}','divisionController@edit');
	Route::put('/divisiones/update/{id}','divisionController@update');
    Route::get('/divisiones/divisiones-modal/{id}','divisionController@divisionModal');
	Route::put('/divisiones/destroy/{id}','divisionController@destroy');
	Route::get('/divisiones/depbydir/{id}','divisionController@depbydir');

});

//**********************Rutas para Departamentos********************************

Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/departamentos', function () {return view('departamentos.create');});
	Route::get('/departamentos/create','departamentoController@create');
	Route::post('/departamentos/store','departamentoController@store');
	Route::get('/departamentos/listDepartamentos','departamentoController@index');
	Route::get('/departamentos/edit/{id}','departamentoController@edit');
	Route::put('/departamentos/update/{id}','departamentoController@update');
    Route::get('/departamentos/departamentos-modal/{id}','departamentoController@departamentoModal');
	Route::put('/departamentos/destroy/{id}','departamentoController@destroy');
	Route::get('/departamentos/dirbydiv/{id}','departamentoController@dirbydiv');

});

//**********************Rutas para Correspondencia********************************

Route::group(['middleware' => ['Outside','HistoryBack']], function () {
    //Rutas externas módulo de usuarios regulares
	Route::get('/prueba','correspondenciaController@prueba');
});