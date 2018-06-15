<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1527584950CatawardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catawards', function (Blueprint $table) {
            if(Schema::hasColumn('catawards', 'created_by_id')) {
                $table->dropForeign('165478_5b0d149d5659d');
                $table->dropIndex('165478_5b0d149d5659d');
                $table->dropColumn('created_by_id');
            }
            if(Schema::hasColumn('catawards', 'created_by_team_id')) {
                $table->dropForeign('165478_5b0d149d62973');
                $table->dropIndex('165478_5b0d149d62973');
                $table->dropColumn('created_by_team_id');
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
        Schema::table('catawards', function (Blueprint $table) {
                        
        });

    }
}
