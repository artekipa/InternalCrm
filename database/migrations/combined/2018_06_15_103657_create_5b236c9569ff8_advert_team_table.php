<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b236c9569ff8AdvertTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('advert_team')) {
            Schema::create('advert_team', function (Blueprint $table) {
                $table->integer('advert_id')->unsigned()->nullable();
                $table->foreign('advert_id', 'fk_p_165544_165461_team_a_5b236c956a195')->references('id')->on('adverts')->onDelete('cascade');
                $table->integer('team_id')->unsigned()->nullable();
                $table->foreign('team_id', 'fk_p_165461_165544_advert_5b236c956a268')->references('id')->on('teams')->onDelete('cascade');
                
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
        Schema::dropIfExists('advert_team');
    }
}
