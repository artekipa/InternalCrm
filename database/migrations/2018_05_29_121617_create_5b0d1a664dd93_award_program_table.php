<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d1a664dd93AwardProgramTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('award_program')) {
            Schema::create('award_program', function (Blueprint $table) {
                $table->integer('award_id')->unsigned()->nullable();
                $table->foreign('award_id', 'fk_p_165479_165485_progra_5b0d1a664de75')->references('id')->on('awards')->onDelete('cascade');
                $table->integer('program_id')->unsigned()->nullable();
                $table->foreign('program_id', 'fk_p_165485_165479_award__5b0d1a664df20')->references('id')->on('programs')->onDelete('cascade');
                
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
        Schema::dropIfExists('award_program');
    }
}
