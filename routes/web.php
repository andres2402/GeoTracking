<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| En este archivo se registran las rutas web del Core y Aplicación. Estas rutas las carga el RouteServiceProvider dentro de un grupo que contiene 
| el grupo de middleware "web". 
|
*/

//Vista de inicio
Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', 'Admin\DashboardController@index')->name('home');
Route::post('password/recovery', 'Admin\UserController@recoverPassword');
Route::get('/recover/{token}', 'HomeController@resetPassword');

Route::group(['middleware' => 'auth'], function () {

//Parametros
	Route::resource('values','Admin\ValuesController' );

//Valor parametros
	Route::resource('valores-parametros', 'Admin\ParametersController');

//Dashborad
	Route::resource('dashboard','Admin\DashboardController');

//Config
	Route::resource('config','Admin\ConfigController')->only(['index','update']);

//Administrador de archivos
	Route::resource('files-admin', 'Admin\FilesAdminController')->only(['index']);

//Usuarios
	Route::resource('users', 'Admin\UserController')->except(['show']);

//Perfil
	Route::get('perfil', 'ProfileController@edit')->name('perfil.edit');
	Route::put('perfil', 'ProfileController@update')->name('perfil.update');
	Route::post('perfil/photo', 'ProfileController@photo')->name('perfil.photo');
	Route::put('perfil/password', 'ProfileController@password')->name('perfil.password');

/*Roles y Permisos*/
	Route::resource('roles', 'Admin\RoleController');

/*Permisos*/
	Route::resource('permits', 'Admin\PermissionController');

/*Accounts*/
	Route::post('accounts/payu/info', 'Admin\AccountController@infoPayu');
	Route::resource('accounts', 'Admin\AccountController')->only(['index']);

/*Clients*/
	// Route::put('clientes/password/{id}', 'Admin\CustomerController@password')->name('clientes.password');
	// Route::get('clientes/exportar', 'Admin\CustomerController@export')->name('clientes.exportar');
    // Route::resource('clientes', 'Admin\CustomerController');

    /*Send SMS e Email*/
	Route::post('alerting/sendSms', 'Admin\AlertingController@sms')->name('notificacion.sendSms');
    Route::post('alerting/sendEmail', 'Admin\AlertingController@email')->name('notificacion.sendEmail');
	Route::resource('alerting', 'Admin\AlertingController');
	
	//Activity log
	Route::resource('log', 'Admin\ActivityLogController');

	// Sliders
	Route::resource('sliders', 'Admin\SliderController');
	Route::post('sliders/media', 'Admin\SliderController@storeMedia')->name('sliders.storeMedia');
	
	Route::resource('subscriptions', 'Admin\SubscriptionController');
	Route::get('{page}','PageController@index')->name('page.index');
});
