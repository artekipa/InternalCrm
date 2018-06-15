<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527598575NominatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nominateds', function (Blueprint $table) {
            
if (!Schema::hasColumn('nominateds', 'materialdates')) {
                $table->date('materialdates')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'docsdate')) {
                $table->date('docsdate')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'matrialtype')) {
                $table->string('matrialtype')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'materialloc')) {
                $table->string('materialloc')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'sitenumber')) {
                $table->integer('sitenumber')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'contactperson')) {
                $table->string('contactperson')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'cpemail')) {
                $table->string('cpemail')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'cpphone')) {
                $table->integer('cpphone')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'presentation_name')) {
                $table->string('presentation_name')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'presentation_site_no')) {
                $table->integer('presentation_site_no')->nullable();
                }
if (!Schema::hasColumn('nominateds', 'member')) {
                $table->tinyInteger('member')->nullable()->default('0');
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
        Schema::table('nominateds', function (Blueprint $table) {
            $table->dropColumn('materialdates');
            $table->dropColumn('docsdate');
            $table->dropColumn('matrialtype');
            $table->dropColumn('materialloc');
            $table->dropColumn('sitenumber');
            $table->dropColumn('contactperson');
            $table->dropColumn('cpemail');
            $table->dropColumn('cpphone');
            $table->dropColumn('presentation_name');
            $table->dropColumn('presentation_site_no');
            $table->dropColumn('member');
            
        });

    }
}
