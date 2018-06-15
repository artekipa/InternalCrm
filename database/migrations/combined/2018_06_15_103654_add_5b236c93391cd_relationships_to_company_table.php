<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c93391cdRelationshipsToCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function(Blueprint $table) {
            if (!Schema::hasColumn('companies', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '165503_5b0d29f90b55f')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('companies', function(Blueprint $table) {
            if(Schema::hasColumn('companies', 'user_id')) {
                $table->dropForeign('165503_5b0d29f90b55f');
                $table->dropIndex('165503_5b0d29f90b55f');
                $table->dropColumn('user_id');
            }
            
        });
    }
}
