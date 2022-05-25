<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSliderMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_slider_id')->references('id')->on('sliders');
            $table->string('filename', 100);
            $table->string('path', 300);
            $table->string('url', 300);
            $table->string('format', 20);
            $table->decimal('width', 8, 2);
            $table->decimal('height', 8, 2);
            $table->decimal('size', 8, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider_media', function (Blueprint $table) {
            //
        });
    }
}
