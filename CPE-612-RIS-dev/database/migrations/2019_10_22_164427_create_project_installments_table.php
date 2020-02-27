<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('no');
            $table->date('promised_date');
            $table->date('receive_date')->nullable();
            $table->decimal('fund',13,2);
            $table->decimal('researcher',13,2)->nullable();
            $table->decimal('ohc',13,2)->nullable();
            $table->decimal('university',13,2)->nullable();
            $table->decimal('faculty',13,2)->nullable();
            $table->decimal('department',13,2)->nullable();
            $table->decimal('fee',13,2)->nullable();
            $table->decimal('advance',13,2)->nullable();
            $table->decimal('insurance',13,2)->nullable();
            $table->string('others')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('project-installments');
    }
}
