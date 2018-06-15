<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1527596374NominatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('nominateds')) {
            Schema::create('nominateds', function (Blueprint $table) {
                $table->increments('id');
                $table->date('materialdates')->nullable();
                $table->date('docsdate')->nullable();
                $table->string('matrialtype')->nullable();
                $table->string('materialloc')->nullable();
                $table->integer('sitenumber')->nullable();
                $table->string('contactperson')->nullable();
                $table->string('cpemail')->nullable();
                $table->integer('cpphone')->nullable();
                $table->string('presentation_name')->nullable();
                $table->integer('presentation_site_no')->nullable();
                $table->tinyInteger('member')->nullable()->default('0');
                $table->text('comments')->nullable();
                $table->integer('eventpersonno')->nullable();
                $table->string('event_person')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('nominateds');
    }
}
