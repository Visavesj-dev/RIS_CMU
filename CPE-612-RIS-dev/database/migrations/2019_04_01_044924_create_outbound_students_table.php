<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutboundStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbound_students', function (Blueprint $table) {
            $table->increments('id');

            // personal info
            $table->integer('student_type_id')->nullable();
            $table->string('student_id');
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('department_id')->nullable();
            $table->integer('advisor_id')->nullable();
            $table->string('telephone');
            $table->string('email');
            $table->string('passport_id');

            // coorperation info
            $table->string('cooperation_name')->nullable();
            $table->string('project')->nullable();
            $table->date('travelled_at')->nullable();
            $table->date('returned_at')->nullable();
            $table->string('university')->nullable();
            $table->string('coordinator_name')->nullable();
            $table->string('coordinator_email')->nullable();
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
        Schema::dropIfExists('outbound_students');
    }
}
