<?php

use Illuminate\Support\Facades\Route;


Route::resource('mapa','MapaModule\Controllers\MapaController')->middleware('auth');






?>