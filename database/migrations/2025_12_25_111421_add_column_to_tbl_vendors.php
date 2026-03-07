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
            //
             $table->string('agent_business_name',255)->after('name')->nullable();
             $table->tinyInteger('business_type')->after('agent_business_name')->nullable();
             $table->string('zone_side',255)->after('business_type')->nullable();
             $table->string('parent_area',255)->after('zone_side')->nullable();
             $table->string('micro_area_galli',255)->after('parent_area')->nullable();
             $table->string('service_area_covered',255)->after('micro_area_galli')->nullable();
             $table->string('property_type',255)->after('service_area_covered')->nullable();
             $table->string('transaction_type',255)->after('property_type')->nullable();
             $table->longText('admin_notes')->after('transaction_type')->nullable();
             $table->string('signup_source',100)->after('admin_notes')->nullable();
             $table->string('verification_status',100)->after('admin_notes')->nullable();
             $table->string('subscription_plan',100)->after('verification_status')->nullable();
             $table->string('subscription_state',100)->after('subscription_plan')->nullable();
             $table->longText('agent_slug')->after('subscription_state')->nullable();
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
