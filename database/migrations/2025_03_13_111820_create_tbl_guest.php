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
        Schema::create('tbl_guest', function (Blueprint $table) {
            $table->id();
            $table->string('prefix_name',50)->nullable();
            $table->string('name',200)->nullable();
            $table->string('mobile',20)->nullable();
            $table->longText('address')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('special_tag',200)->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('event_id')->nullable();
            $table->integer('subevent_id')->nullable();
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
        Schema::dropIfExists('tbl_guest');
    }
};
