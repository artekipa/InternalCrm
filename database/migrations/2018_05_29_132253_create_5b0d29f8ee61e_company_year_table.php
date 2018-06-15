<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5b0d29f8ee61eCompanyYearTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('company_year')) {
            Schema::create('company_year', function (Blueprint $table) {
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', 'fk_p_165503_165491_year_c_5b0d29f8ee729')->references('id')->on('companies')->onDelete('cascade');
                $table->integer('year_id')->unsigned()->nullable();
                $table->foreign('year_id', 'fk_p_165491_165503_compan_5b0d29f8ee801')->references('id')->on('years')->onDelete('cascade');
                
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
        Schema::dropIfExists('company_year');
    }
}
