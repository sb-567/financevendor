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
        Schema::table('tbl_blogs', function (Blueprint $table) {
            //
             $table->string('meta_title',255)->after('description')->nullable();
             $table->string('meta_description',255)->after('meta_title')->nullable();
             $table->string('image_alt',255)->after('image')->nullable();
             $table->string('slug',255)->after('blog_title')->nullable();
             $table->string('og_title',255)->after('meta_description')->nullable();
           
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
    }
};
