<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d1a664b7deProgramProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('program_project')) {
            Schema::create('program_project', function (Blueprint $table) {
                $table->integer('program_id')->unsigned()->nullable();
                $table->foreign('program_id', 'fk_p_165485_165481_projec_5b0d1a664b8d5')->references('id')->on('programs')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_165481_165485_progra_5b0d1a664b95d')->references('id')->on('projects')->onDelete('cascade');
                
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
        Schema::dropIfExists('program_project');
    }
}
