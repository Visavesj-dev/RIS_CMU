<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboundStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_students', function (Blueprint $table) {
            $table->increments('id');

            // personal info
            $table->integer('student_type_id')->nullable();
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('university', 200);
            $table->integer('country_id')->nullable();
            $table->string('email');
            $table->string('passport_id');

            // coorperation info
            $table->string('cooperation_name');
            $table->string('project');
            $table->date('arrived_at');
            $table->date('departed_at');
            $table->integer('department_id')->nullable();
            $table->integer('lecturer_id')->nullable();
            $table->string('degree');

            // Uni info
            $table->string('student_id')->nullable();
            $table->string('telephone')->nullable();
            $table->string('subject')->nullable();
            $table->string('accommodation')->nullable();
            $table->text('note')->nullable();

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
        Schema::dropIfExists('inbound_students');
    }
}
