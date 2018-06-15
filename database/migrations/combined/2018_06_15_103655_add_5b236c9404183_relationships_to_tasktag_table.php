<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c9404183RelationshipsToTaskTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_tags', function(Blueprint $table) {
            if (!Schema::hasColumn('task_tags', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165464_5b0d103c70f1c')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('task_tags', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165464_5b0d103c7e18a')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('task_tags', function(Blueprint $table) {
            if(Schema::hasColumn('task_tags', 'created_by_id')) {
                $table->dropForeign('165464_5b0d103c70f1c');
                $table->dropIndex('165464_5b0d103c70f1c');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('task_tags', 'created_by_team_id')) {
                $table->dropForeign('165464_5b0d103c7e18a');
                $table->dropIndex('165464_5b0d103c7e18a');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
