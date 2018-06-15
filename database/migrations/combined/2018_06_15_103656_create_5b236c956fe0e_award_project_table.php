<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b236c956fe0eAwardProjectTable extends Migration
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
                $table->foreign('award_id', 'fk_p_165479_165481_projec_5b236c956ff72')->references('id')->on('awards')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_165481_165479_award__5b236c9570041')->references('id')->on('projects')->onDelete('cascade');
                
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
