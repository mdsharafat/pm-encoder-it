<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Carbon\Carbon;

class CreateLeaveManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_managements', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->string('unique_key');
            $table->tinyInteger('status')->nullable();
            $table->string('category')->default(1);
            $table->date('date')->default(Carbon::now());
            $table->text('reason')->nullable();
            $table->string('action_by')->nullable();
            $table->timestamps();
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
        Schema::drop('leave_managements');
    }
}
