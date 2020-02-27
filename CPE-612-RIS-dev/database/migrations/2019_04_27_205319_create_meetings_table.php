<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('head_of_project');
            $table->integer('department_id')->nullable()->index();
            $table->decimal('budget', 13, 2)->default(0);
            $table->string('meeting_place');
            $table->boolean('authorize_financial')->default(false);
            $table->string('autorize_other')->nullable();
            $table->string('procurement_act')->nullable();
            $table->date('started_at');
            $table->date('ended_at');
            $table->decimal('actual_expenses', 13, 2)->nullable();
            $table->decimal('net_income', 13, 2)->nullable(); // รายได้หักรายจ่าย
            $table->decimal('university_share', 13, 2)->nullable(); // รายได้ส่ง มช
            $table->decimal('faculty_share', 13, 2)->nullable(); // รายได้ส่ง มช
            $table->decimal('department_share', 13, 2)->nullable(); // รายได้ส่ง มช
            $table->text('note')->nullable(); 
            $table->date('closed_at')->nullable();

            $table->longText('outcome')->nullable();
            
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
        Schema::dropIfExists('meetings');
    }
}
