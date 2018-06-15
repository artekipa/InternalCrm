<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1529048210YearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('years', function (Blueprint $table) {
            if(Schema::hasColumn('years', 'created_by_id')) {
                $table->dropForeign('165491_5b0d2146adbe6');
                $table->dropIndex('165491_5b0d2146adbe6');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('years', 'created_by_team_id')) {
                $table->dropForeign('165491_5b0d2146ba46e');
                $table->dropIndex('165491_5b0d2146ba46e');
                $table->dropColumn('created_by_team_id');
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
        Schema::table('years', function (Blueprint $table) {
                        
        });

    }
}
