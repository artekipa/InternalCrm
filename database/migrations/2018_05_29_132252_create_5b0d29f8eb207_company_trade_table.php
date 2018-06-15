<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d29f8eb207CompanyTradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('company_trade')) {
            Schema::create('company_trade', function (Blueprint $table) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', 'fk_p_165503_165493_trade__5b0d29f8eb318')->references('id')->on('companies')->onDelete('cascade');
                $table->integer('trade_id')->unsigned()->nullable();
                $table->foreign('trade_id', 'fk_p_165493_165503_compan_5b0d29f8eb3a7')->references('id')->on('trades')->onDelete('cascade');
                
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
        Schema::dropIfExists('company_trade');
    }
}
