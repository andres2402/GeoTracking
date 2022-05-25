<?php

use Illuminate\Support\Facades\Route;

Route::resource('empresa','EmpresaModule\Controllers\EmpresaController')->middleware('auth');
Route::get('empresa/{empresa}/delete','EmpresaModule\Controllers\EmpresaController@destroy')->name('empresa.destroy');

?>