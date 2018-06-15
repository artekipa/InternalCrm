<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527598815NominatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nominateds', function (Blueprint $table) {
            
if (!Schema::hasColumn('nominateds', 'comments')) {
                $table->text('comments')->nullable();
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
            $table->dropColumn('comments');
            
        });

    }
}
