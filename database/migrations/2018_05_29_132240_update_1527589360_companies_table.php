<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527589360CompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            
if (!Schema::hasColumn('companies', 'persontitle')) {
                $table->string('persontitle')->nullable();
                }
if (!Schema::hasColumn('companies', 'personname')) {
                $table->string('personname')->nullable();
                }
if (!Schema::hasColumn('companies', 'name')) {
                $table->string('name')->nullable();
                }
if (!Schema::hasColumn('companies', 'zipcode')) {
                $table->string('zipcode')->nullable();
                }
if (!Schema::hasColumn('companies', 'city')) {
                $table->string('city')->nullable();
                }
if (!Schema::hasColumn('companies', 'phone')) {
                $table->integer('phone')->nullable();
                }
if (!Schema::hasColumn('companies', 'email')) {
                $table->string('email')->nullable();
                }
if (!Schema::hasColumn('companies', 'website')) {
                $table->string('website')->nullable();
                }
if (!Schema::hasColumn('companies', 'comments')) {
                $table->text('comments')->nullable();
                }
if (!Schema::hasColumn('companies', 'nomination')) {
                $table->string('nomination')->nullable();
                }
if (!Schema::hasColumn('companies', 'senddate')) {
                $table->date('senddate')->nullable();
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
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('persontitle');
            $table->dropColumn('personname');
            $table->dropColumn('name');
            $table->dropColumn('zipcode');
            $table->dropColumn('city');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('website');
            $table->dropColumn('comments');
            $table->dropColumn('nomination');
            $table->dropColumn('senddate');
            
        });

    }
}
