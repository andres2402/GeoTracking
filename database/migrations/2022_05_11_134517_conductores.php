<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Conductores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('conductors', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('Con_nombre');
            $table->string('Con_apellido');
            $table->bigInteger('Con_telefono');
            $table->string('Con_direccion');
            $table->string('Con_estado');
            $table->bigInteger('Con_n_pase');
            $table->string('Con_c_pase');
            $table->bigInteger('Con_n_documento');
            $table->string('Con_c_documento');
            $table->string('Con_c_hoja_vida');
            // $table->softDeletes();
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
        //
        Schema::dropIfExists('conductors');
    }
}