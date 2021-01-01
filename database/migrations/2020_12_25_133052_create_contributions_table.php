<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->float('contribution')->nullable();
            $table->string('unique_key');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contributions');
    }
}
