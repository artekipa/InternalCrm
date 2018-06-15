<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b236c9567fe7AdvertCatadvertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('advert_catadvert')) {
            Schema::create('advert_catadvert', function (Blueprint $table) {
                $table->integer('advert_id')->unsigned()->nullable();
                $table->foreign('advert_id', 'fk_p_165544_165540_catadv_5b236c956816e')->references('id')->on('adverts')->onDelete('cascade');
                $table->integer('catadvert_id')->unsigned()->nullable();
                $table->foreign('catadvert_id', 'fk_p_165540_165544_advert_5b236c9568244')->references('id')->on('catadverts')->onDelete('cascade');
                
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
        Schema::dropIfExists('advert_catadvert');
    }
}
