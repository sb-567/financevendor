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
        Schema::create('tbl_subscription', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable();
            $table->string('price',255)->nullable();
            $table->string('cross_price',255)->nullable();
            $table->string('offer_text',255)->nullable();
            $table->text('plan_ids')->nullable();
            $table->integer('status')->default(1)->comment('1=active,0=inactive');
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
        Schema::dropIfExists('tbl_subscription');
    }
};
