<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b236c9273ccfRelationshipsToNominatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nominateds', function(Blueprint $table) {
            if (!Schema::hasColumn('nominateds', 'company_id')) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', '165546_5b0d4562d6c4a')->references('id')->on('companies')->onDelete('cascade');
                }
                if (!Schema::hasColumn('nominateds', 'cataward_id')) {
                $table->integer('cataward_id')->unsigned()->nullable();
                $table->foreign('cataward_id', '165546_5b2368305e87b')->references('id')->on('catawards')->onDelete('cascade');
                }
                if (!Schema::hasColumn('nominateds', 'year_id')) {
                $table->integer('year_id')->unsigned()->nullable();
                $table->foreign('year_id', '165546_5b0d4df61b46d')->references('id')->on('years')->onDelete('cascade');
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
        Schema::table('nominateds', function(Blueprint $table) {
            if(Schema::hasColumn('nominateds', 'company_id')) {
                $table->dropForeign('165546_5b0d4562d6c4a');
                $table->dropIndex('165546_5b0d4562d6c4a');
                $table->dropColumn('company_id');
            }
            if(Schema::hasColumn('nominateds', 'cataward_id')) {
                $table->dropForeign('165546_5b2368305e87b');
                $table->dropIndex('165546_5b2368305e87b');
                $table->dropColumn('cataward_id');
            }
            if(Schema::hasColumn('nominateds', 'year_id')) {
                $table->dropForeign('165546_5b0d4df61b46d');
                $table->dropIndex('165546_5b0d4df61b46d');
                $table->dropColumn('year_id');
            }
            
        });
    }
}
