<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d4df5f00b0NominatedOrganizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('nominated_organization')) {
            Schema::create('nominated_organization', function (Blueprint $table) {
                $table->integer('nominated_id')->unsigned()->nullable();
                $table->foreign('nominated_id', 'fk_p_165546_165556_organi_5b0d4df5f01a7')->references('id')->on('nominateds')->onDelete('cascade');
                $table->integer('organization_id')->unsigned()->nullable();
                $table->foreign('organization_id', 'fk_p_165556_165546_nomina_5b0d4df5f023e')->references('id')->on('organizations')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominated_organization');
    }
}
