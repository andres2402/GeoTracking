<?php

use Illuminate\Support\Facades\Route;


Route::resource('vehiculo','VehiculoModule\Controllers\VehiculoController')->middleware('auth');
Route::get('vehiculo/{vehiculo}','VehiculoModule\Controllers\VehiculoController@destroy')->name('vehiculo.destroy');


?>