<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b236c95603f0CompanyVivodeshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('company_vivodeship')) {
            Schema::create('company_vivodeship', function (Blueprint $table) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', 'fk_p_165503_165492_vivode_5b236c95605b2')->references('id')->on('companies')->onDelete('cascade');
                $table->integer('vivodeship_id')->unsigned()->nullable();
                $table->foreign('vivodeship_id', 'fk_p_165492_165503_compan_5b236c9560684')->references('id')->on('vivodeships')->onDelete('cascade');
                
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
        Schema::dropIfExists('company_vivodeship');
    }
}
