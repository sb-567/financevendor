<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_subscription', function (Blueprint $table) {
            $table->string('subscription_type')->after('cross_price')->nullable();
            $table->string('no_of_leads')->after('subscription_type')->nullable();
            $table->string('time_duration')->after('no_of_leads')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_subscription', function (Blueprint $table) {
            //
        });
    }
};
