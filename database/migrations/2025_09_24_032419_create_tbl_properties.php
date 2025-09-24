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
        Schema::create('tbl_properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name',255)->nullable();
            $table->string('facing_direction',255)->nullable();
            $table->string('apartment_type',255)->nullable();
            $table->string('no_of_bathroom',255)->nullable();
            $table->string('parking_availability',255)->nullable();
            $table->string('property_images',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('area',255)->nullable();
            $table->string('pincode',255)->nullable();
            $table->string('availability_status',255)->nullable();
            $table->string('price_type',255)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('tbl_properties');
    }
};
