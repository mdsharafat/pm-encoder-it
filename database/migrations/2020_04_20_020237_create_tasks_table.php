<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('unique_key');
            $table->text('task')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->float('total_point')->default(1.00);
            $table->float('received_point')->default(0.00);
            $table->timestamps();
            $table->foreign('assigned_to')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
