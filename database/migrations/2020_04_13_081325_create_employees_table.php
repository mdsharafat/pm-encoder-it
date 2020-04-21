<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('job_type_id')->nullable();
            $table->string('full_name')->nullable();
            $table->date('date_of_join')->nullable();
            $table->string('phone')->nullable();
            $table->string('email_personal')->nullable();
            $table->string('nid')->nullable();
            $table->string('image')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->boolean('marital_status')->default(0);
            $table->tinyInteger('gender')->default(1);
            $table->text('desc')->nullable();
            $table->integer('current_salary')->default(0);
            $table->string('updated_by')->nullable();
            $table->boolean('job_status')->default(0);
            $table->date('date_of_resign')->nullable();
            $table->string('reason_of_resign')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
