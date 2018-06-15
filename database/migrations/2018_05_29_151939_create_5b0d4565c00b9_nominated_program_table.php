<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d4565c00b9NominatedProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('nominated_program')) {
            Schema::create('nominated_program', function (Blueprint $table) {
                $table->integer('nominated_id')->unsigned()->nullable();
                $table->foreign('nominated_id', 'fk_p_165546_165485_progra_5b0d4565c01a4')->references('id')->on('nominateds')->onDelete('cascade');
                $table->integer('program_id')->unsigned()->nullable();
                $table->foreign('program_id', 'fk_p_165485_165546_nomina_5b0d4565c0228')->references('id')->on('programs')->onDelete('cascade');
                
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
        Schema::dropIfExists('nominated_program');
    }
}
