<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizeListAssociablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorize_list_associables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('authorize_list_id');
            $table->integer('authorize_list_associable_id');
            $table->string('authorize_list_associable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorize_list_associables');
    }
}
