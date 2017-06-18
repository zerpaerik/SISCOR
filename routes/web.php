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
	Route::get('/user', function () {return view('user.loginUser');});
	Route::post('/login','userController@login');
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