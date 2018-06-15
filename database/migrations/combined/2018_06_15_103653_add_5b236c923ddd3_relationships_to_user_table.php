<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c923ddd3RelationshipsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            if (!Schema::hasColumn('users', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '164786_5b0d131da35bd')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('users', 'team_id')) {
                $table->integer('team_id')->unsigned()->nullable();
                $table->foreign('team_id', '164786_5b0d0cb509be6')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::table('users', function(Blueprint $table) {
            if(Schema::hasColumn('users', 'created_by_id')) {
                $table->dropForeign('164786_5b0d131da35bd');
                $table->dropIndex('164786_5b0d131da35bd');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('users', 'team_id')) {
                $table->dropForeign('164786_5b0d0cb509be6');
                $table->dropIndex('164786_5b0d0cb509be6');
                $table->dropColumn('team_id');
            }
            
        });
    }
}
