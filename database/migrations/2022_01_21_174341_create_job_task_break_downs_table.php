<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTaskBreakDownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_task_break_downs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->unsignedBigInteger('job_type_id')->index();
            $table->unsignedBigInteger('template_id')->index();
            $table->unsignedBigInteger('job_id')->index();
            $table->unsignedBigInteger('task_id')->index();
            $table->unsignedInteger('task_sequence');
            $table->tinyInteger('task_completion_basis')->nullable()->comment("1=Day, 2=Hour, 3=Minute");
            $table->string('task_completion_time')->nullable();
            $table->date('estimated_start_date')->nullable();
            $table->date('estimated_end_date')->nullable();
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->string('actual_task_completion_time')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable()->comment("Assigned User Id")->index();
            $table->string('attachment')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('completion_status')->default(0)->comment("0=No,1=Yes")->index();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_task_break_downs');
    }
}
