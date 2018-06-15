<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527583517UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
if (!Schema::hasColumn('users', 'firstname')) {
                $table->string('firstname')->nullable();
                }
if (!Schema::hasColumn('users', 'lastname')) {
                $table->string('lastname')->nullable();
                }
if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
                }
if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable();
                }
if (!Schema::hasColumn('users', 'codenumber')) {
                $table->integer('codenumber')->nullable();
                }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('phone');
            $table->dropColumn('avatar');
            $table->dropColumn('codenumber');
            
        });

    }
}
