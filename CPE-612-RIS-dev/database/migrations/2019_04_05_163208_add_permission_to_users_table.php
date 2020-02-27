<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);

            $table->boolean('has_research_read')->default(false);
            $table->boolean('has_research_write')->default(false);

            $table->boolean('has_service_read')->default(false);
            $table->boolean('has_service_write')->default(false);

            $table->boolean('has_meeting_read')->default(false);
            $table->boolean('has_meeting_write')->default(false);

            $table->boolean('has_foreign_read')->default(false);
            $table->boolean('has_foreign_write')->default(false);
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
            $table->dropColumn('is_admin');

            $table->dropColumn('has_research_read');
            $table->dropColumn('has_research_write');

            $table->dropColumn('has_service_read');
            $table->dropColumn('has_service_write');

            $table->dropColumn('has_meeting_read');
            $table->dropColumn('has_meeting_write');
            
            $table->dropColumn('has_foreign_read');
            $table->dropColumn('has_foreign_write');
        });
    }
}
