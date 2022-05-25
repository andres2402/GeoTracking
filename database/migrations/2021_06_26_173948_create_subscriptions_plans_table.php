<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 200);
            $table->decimal('price', 19, 2)->default(1);
            $table->decimal('price_by_day', 19, 2)->nullable()->default(1);
            $table->decimal('discount_value', 19, 2)->nullable()->default(1);
            $table->foreignId('fk_user_id')->nullable()->references('id')->on('users');
            // $table->foreignId('fk_user_id')->references('id')->on('users')->nullable();
            $table->text('image_filename');
            $table->integer('limit_offered_services');
            $table->integer('limit_accepted_services');
            $table->integer('limit_monthly_promos');
            $table->integer('limit_shared_images');
            $table->integer('limit_profile_updates');
            $table->boolean('location');
            $table->boolean('active');
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
        Schema::dropIfExists('subscriptions_plans');
    }
}
