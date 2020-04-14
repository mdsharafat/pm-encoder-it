<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('platform_id')->nullable();
            $table->integer('budget')->default(0);
            $table->unsignedBigInteger('project_status_id')->default(1);
            $table->date('deadline')->nullable();
            $table->text('desc')->nullable();
            $table->string('git_repo')->nullable();
            $table->string('trello_link')->nullable();
            $table->string('gd_link')->nullable();
            $table->string('demo_web_link')->nullable();
            $table->string('live_project_link')->nullable();
            $table->float('feedback_from_client')->default(0.00);
            $table->float('feedback_to_client')->default(0.00);
            $table->tinyInteger('payment_status')->default(1);
            $table->integer('payment_received')->default(0);
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            $table->foreign('project_status_id')->references('id')->on('project_statuses')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
