<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d188ddc975AwardProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('award_project')) {
            Schema::create('award_project', function (Blueprint $table) {
                $table->integer('award_id')->unsigned()->nullable();
                $table->foreign('award_id', 'fk_p_165479_165481_projec_5b0d188ddca81')->references('id')->on('awards')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_165481_165479_award__5b0d188ddcb13')->references('id')->on('projects')->onDelete('cascade');
                
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
        Schema::dropIfExists('award_project');
    }
}
