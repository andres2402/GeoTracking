<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Vehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->bigInteger('Veh_Con_id')->unsigned();
            $table->bigInteger('Veh_documento');
            $table->string('Veh_modelo');
            $table->bigInteger('Veh_año');
            $table->string('Veh_estado');
            $table->string('Veh_placa');
            $table->string('Veh_matricula');
            $table->bigInteger('Veh_soat');
            $table->bigInteger('Veh_tecnomecanica');
            $table->string('Veh_c_soat');
            $table->string('Veh_c_t_mecanica');
            $table->string('Veh_c_t_propiedad');
            // $table->softDeletes();
            $table->timestamps();
            $table->foreign('Veh_Con_id')->references('id')->on('conductors')->onDelete("cascade");
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
        Schema::dropIfExists('vehiculos');
    }
}
