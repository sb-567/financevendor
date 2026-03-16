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
        Schema::table('tbl_vendors', function (Blueprint $table) {
                         $table->integer('is_rera_certificate_verified')->nullable()->after('password');
             $table->integer('is_pancard_verified')->nullable()->after('is_rera_certificate_verified');
             $table->integer('is_real_estate_certificate_verified')->nullable()->after('is_pancard_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_vendors', function (Blueprint $table) {
            //
        });
    }
};
