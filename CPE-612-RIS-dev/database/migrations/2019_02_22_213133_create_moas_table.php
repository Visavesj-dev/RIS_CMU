<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('detail');
            $table->dateTime('made_agreement_at');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->integer('department_id')->nullable();
            $table->integer('mou_id')->nullable();
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
        Schema::dropIfExists('moas');
    }
}
