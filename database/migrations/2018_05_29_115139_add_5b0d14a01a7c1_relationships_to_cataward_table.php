<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b0d14a01a7c1RelationshipsToCatawardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catawards', function(Blueprint $table) {
            if (!Schema::hasColumn('catawards', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165478_5b0d149d5659d')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('catawards', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165478_5b0d149d62973')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('catawards', function(Blueprint $table) {
            
        });
    }
}
