<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d4565c507aAwardNominatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('award_nominated')) {
            Schema::create('award_nominated', function (Blueprint $table) {
                $table->integer('award_id')->unsigned()->nullable();
                $table->foreign('award_id', 'fk_p_165479_165546_nomina_5b0d4565c515e')->references('id')->on('awards')->onDelete('cascade');
                $table->integer('nominated_id')->unsigned()->nullable();
                $table->foreign('nominated_id', 'fk_p_165546_165479_award__5b0d4565c51e3')->references('id')->on('nominateds')->onDelete('cascade');
                
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
        Schema::dropIfExists('award_nominated');
    }
}
