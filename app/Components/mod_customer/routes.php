<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', 'mod_customer\CustomerController@index');
Route::put('clientes/password/{id}', 'mod_customer\CustomerController@password')->name('clientes.password');
Route::get('clientes/exportar', 'mod_customer\CustomerController@export')->name('clientes.exportar');
Route::resource('clientes', 'mod_customer\CustomerController');
