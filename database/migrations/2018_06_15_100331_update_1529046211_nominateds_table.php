<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1529046211NominatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nominateds', function (Blueprint $table) {
            
if (!Schema::hasColumn('nominateds', 'event_person')) {
                $table->string('event_person')->nullable();
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
            $table->dropColumn('event_person');
            
        });

    }
}
