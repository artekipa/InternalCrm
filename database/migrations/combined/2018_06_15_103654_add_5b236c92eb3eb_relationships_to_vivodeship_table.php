<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c92eb3ebRelationshipsToVivodeshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vivodeships', function(Blueprint $table) {
            if (!Schema::hasColumn('vivodeships', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165492_5b0d21dd61cc1')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vivodeships', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165492_5b0d21dd6c78b')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('vivodeships', function(Blueprint $table) {
            if(Schema::hasColumn('vivodeships', 'created_by_id')) {
                $table->dropForeign('165492_5b0d21dd61cc1');
                $table->dropIndex('165492_5b0d21dd61cc1');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('vivodeships', 'created_by_team_id')) {
                $table->dropForeign('165492_5b0d21dd6c78b');
                $table->dropIndex('165492_5b0d21dd6c78b');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
