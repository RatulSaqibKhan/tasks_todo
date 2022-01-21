<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateTasksMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_tasks_mappings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('task_sequence');
            $table->unsignedBigInteger('company_id')->index();
            $table->unsignedBigInteger('template_id')->index();
            $table->unsignedBigInteger('task_id')->index();
            $table->tinyInteger('task_completion_basis')->nullable()->comment("1=Day, 2=Hour, 3=Minute");
            $table->string('task_completion_time')->nullable();
            $table->tinyInteger('active_status')->default(1)->comment("0=No,1=Yes");
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('template_tasks_mappings');
    }
}
