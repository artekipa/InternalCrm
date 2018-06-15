<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d4051b98f4AdvertTeamTable extends Migration
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
                $table->foreign('advert_id', 'fk_p_165544_165461_team_a_5b0d4051b99db')->references('id')->on('adverts')->onDelete('cascade');
                $table->integer('team_id')->unsigned()->nullable();
                $table->foreign('team_id', 'fk_p_165461_165544_advert_5b0d4051b9a78')->references('id')->on('teams')->onDelete('cascade');
                
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
