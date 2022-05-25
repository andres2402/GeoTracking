<?php

use Illuminate\Support\Facades\Route;

Route::resource('conductor','ConductorModule\Controllers\ConductorController')->middleware('auth');
Route::get('conductor/{conductor}/delete','ConductorModule\Controllers\ConductorController@destroy')->name('conductor.destroy');              


?>