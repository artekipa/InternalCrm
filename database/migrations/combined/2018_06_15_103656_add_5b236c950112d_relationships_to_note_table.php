<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c950112dRelationshipsToNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function(Blueprint $table) {
            if (!Schema::hasColumn('notes', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165488_5b0d1cf76b914')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('notes', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165488_5b0d1cf778832')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('notes', function(Blueprint $table) {
            if(Schema::hasColumn('notes', 'created_by_id')) {
                $table->dropForeign('165488_5b0d1cf76b914');
                $table->dropIndex('165488_5b0d1cf76b914');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('notes', 'created_by_team_id')) {
                $table->dropForeign('165488_5b0d1cf778832');
                $table->dropIndex('165488_5b0d1cf778832');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
