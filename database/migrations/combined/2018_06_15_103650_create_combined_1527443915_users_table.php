<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1527443915UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('firstname')->nullable();
                $table->string('lastname')->nullable();
                $table->string('phone')->nullable();
                $table->string('avatar')->nullable();
                $table->string('email');
                $table->string('password');
                $table->integer('codenumber')->nullable();
                $table->string('remember_token')->nullable();
                $table->tinyInteger('approved')->nullable()->default('0');
                
                $table->timestamps();
                
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
        Schema::dropIfExists('users');
    }
}
