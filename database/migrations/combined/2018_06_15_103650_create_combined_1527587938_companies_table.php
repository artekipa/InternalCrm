<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1527587938CompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('adress_address')->nullable();
                $table->double('adress_latitude')->nullable();
                $table->double('adress_longitude')->nullable();
                $table->string('persontitle')->nullable();
                $table->string('personname')->nullable();
                $table->string('zipcode')->nullable();
                $table->string('city')->nullable();
                $table->integer('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('website')->nullable();
                $table->text('comments')->nullable();
                $table->string('nomination')->nullable();
                $table->date('senddate')->nullable();
                
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
        Schema::dropIfExists('companies');
    }
}
