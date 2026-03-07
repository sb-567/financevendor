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
        Schema::table('tbl_leads', function (Blueprint $table) {
             $table->string('area_name',255)->after('phone')->nullable();
             $table->string('city_name',255)->after('area_name')->nullable();
             $table->string('local_area_name',255)->after('city_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_leads', function (Blueprint $table) {
            //
        });
    }
};
