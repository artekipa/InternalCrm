<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b236c9571f41AwardCatawardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('award_cataward')) {
            Schema::create('award_cataward', function (Blueprint $table) {
                $table->integer('award_id')->unsigned()->nullable();
                $table->foreign('award_id', 'fk_p_165479_165478_catawa_5b236c95720c8')->references('id')->on('awards')->onDelete('cascade');
                $table->integer('cataward_id')->unsigned()->nullable();
                $table->foreign('cataward_id', 'fk_p_165478_165479_award__5b236c957219f')->references('id')->on('catawards')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('award_cataward');
    }
}
