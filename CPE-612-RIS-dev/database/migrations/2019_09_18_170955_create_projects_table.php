<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_type');
            $table->string('project_name');
             $table->string('strategy_type');
             $table->string('cmu_mis_code');
             $table->string('fund_type');
             $table->string('fund_source');
             $table->date('started_at')->nullable();
             $table->date('ended_at')->nullable();
             $table->string('fund_giver_name');
             $table->string('fund_giver_address');
             $table->string('receipt_list');
             $table->float('percent_OHC',13,2);
             $table->integer('all_money_project');
             $table->integer('all_OHC');
             //$table->integer('period_calculation');
             $table->string('project_status');
             $table->string('head_project');
             $table->string('department_subject');
             //$table->integer('researcher');
             $table->string('OHC_type');
             $table->float('cmu',13,2);
             $table->float('faculty',13,2);
             $table->float('department',13,2);
             $table->string('reason')->nullable();

            // $table->integer('present_fund');
            // $table->integer('accept_fund');
            // $table->integer('time_no');
            // $table->string('end_time');

            $table->date('close_project')->nullable();
             $table->string('result_project')->nullable();
             $table->string('result_detail')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
