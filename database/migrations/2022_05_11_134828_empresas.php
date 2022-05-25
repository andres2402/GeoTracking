<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('Em_nombre');
            $table->string('Em_kit');
            $table->string('Em_direccion');
            $table->string('Em_per_cont');
            $table->bigInteger('Em_tel_Cont');
            $table->string('Em_logo');
            $table->string('Em_correo');
            $table->text('Em_contrasena');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}