<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527582780TaskTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_tags', function (Blueprint $table) {
            if(Schema::hasColumn('task_tags', 'created_by_id')) {
                $table->dropForeign('fk_165464_user_created_by_id_task_tag');
                $table->dropIndex('fk_165464_user_created_by_id_task_tag');
                $table->dropColumn('created_by_id');
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
        Schema::table('task_tags', function (Blueprint $table) {
                        
        });

    }
}
