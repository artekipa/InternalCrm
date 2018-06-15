<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d1cfa7f237CatnoteNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('catnote_note')) {
            Schema::create('catnote_note', function (Blueprint $table) {
                $table->integer('catnote_id')->unsigned()->nullable();
                $table->foreign('catnote_id', 'fk_p_165487_165488_note_c_5b0d1cfa7f34f')->references('id')->on('catnotes')->onDelete('cascade');
                $table->integer('note_id')->unsigned()->nullable();
                $table->foreign('note_id', 'fk_p_165488_165487_catnot_5b0d1cfa7f3dd')->references('id')->on('notes')->onDelete('cascade');
                
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
        Schema::dropIfExists('catnote_note');
    }
}
