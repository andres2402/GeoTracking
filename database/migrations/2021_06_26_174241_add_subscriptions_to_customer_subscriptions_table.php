<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriptionsToCustomerSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_subscriptions', function (Blueprint $table) {
            $table->string('name', 100)->nullable()->after('month_date');
            $table->string('description', 200)->nullable()->after('name');
            $table->decimal('price', 19, 2)->nullable()->after('description');
            $table->decimal('price_by_day', 19, 2)->nullable()->after('price');
            $table->string('discount_value', 19, 2)->nullable()->after('price_by_day');
            $table->integer('limit_offered_services')->nullable()->after('discount_value');
            $table->integer('limit_accepted_services')->nullable()->after('limit_offered_services');
            $table->integer('limit_monthly_promos')->nullable()->after('limit_accepted_services');
            $table->integer('limit_shared_images')->nullable()->after('limit_monthly_promos');
            $table->integer('limit_profile_updates')->nullable()->after('limit_shared_images');
            $table->boolean('location')->nullable()->after('limit_profile_updates');
            $table->boolean('active')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_subscriptions', function (Blueprint $table) {
            //
        });
    }
}
