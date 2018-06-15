<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c94a5fbbRelationshipsToCatnoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catnotes', function(Blueprint $table) {
            if (!Schema::hasColumn('catnotes', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165487_5b0d1bc18a99e')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('catnotes', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165487_5b0d1bc1976ce')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('catnotes', function(Blueprint $table) {
            if(Schema::hasColumn('catnotes', 'created_by_id')) {
                $table->dropForeign('165487_5b0d1bc18a99e');
                $table->dropIndex('165487_5b0d1bc18a99e');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('catnotes', 'created_by_team_id')) {
                $table->dropForeign('165487_5b0d1bc1976ce');
                $table->dropIndex('165487_5b0d1bc1976ce');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
