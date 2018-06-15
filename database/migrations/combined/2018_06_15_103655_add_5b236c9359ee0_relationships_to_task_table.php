<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c9359ee0RelationshipsToTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function(Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'status_id')) {
                $table->integer('status_id')->unsigned()->nullable();
                $table->foreign('status_id', '165465_5b0d0cf0efde5')->references('id')->on('task_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('tasks', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '165465_5b0d0cf108b46')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('tasks', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '165465_5b0d0ed445f6b')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('tasks', 'created_by_team_id')) {
                $table->integer('created_by_team_id')->unsigned()->nullable();
                $table->foreign('created_by_team_id', '165465_5b0d0ed453734')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('tasks', function(Blueprint $table) {
            if(Schema::hasColumn('tasks', 'status_id')) {
                $table->dropForeign('165465_5b0d0cf0efde5');
                $table->dropIndex('165465_5b0d0cf0efde5');
                $table->dropColumn('status_id');
            }
            if(Schema::hasColumn('tasks', 'user_id')) {
                $table->dropForeign('165465_5b0d0cf108b46');
                $table->dropIndex('165465_5b0d0cf108b46');
                $table->dropColumn('user_id');
            }
            if(Schema::hasColumn('tasks', 'created_by_id')) {
                $table->dropForeign('165465_5b0d0ed445f6b');
                $table->dropIndex('165465_5b0d0ed445f6b');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('tasks', 'created_by_team_id')) {
                $table->dropForeign('165465_5b0d0ed453734');
                $table->dropIndex('165465_5b0d0ed453734');
                $table->dropColumn('created_by_team_id');
            }
            
        });
    }
}
