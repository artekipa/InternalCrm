<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c9457564RelationshipsToAwardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('awards', function(Blueprint $table) {
            if (!Schema::hasColumn('awards', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165479_5b0d16ea590f5')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('awards', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165479_5b0d16ea68d44')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('awards', function(Blueprint $table) {
            if(Schema::hasColumn('awards', 'created_by_id')) {
                $table->dropForeign('165479_5b0d16ea590f5');
                $table->dropIndex('165479_5b0d16ea590f5');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('awards', 'created_by_team_id')) {
                $table->dropForeign('165479_5b0d16ea68d44');
                $table->dropIndex('165479_5b0d16ea68d44');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
