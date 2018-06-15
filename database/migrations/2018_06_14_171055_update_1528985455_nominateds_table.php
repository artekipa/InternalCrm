<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1528985455NominatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nominateds', function (Blueprint $table) {
            
if (!Schema::hasColumn('nominateds', 'eventpersonno')) {
                $table->integer('eventpersonno')->nullable();
                }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nominateds', function (Blueprint $table) {
            $table->dropColumn('eventpersonno');
            
        });

    }
}
