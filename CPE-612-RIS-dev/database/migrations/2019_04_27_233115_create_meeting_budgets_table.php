<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('expect_amount', 13, 2)->default(0);
            $table->decimal('actual_amount', 13, 2)->default(0);
            $table->text('note')->nullable();
            $table->integer('meeting_id')->index();
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
        Schema::dropIfExists('meeting_budgets');
    }
}
