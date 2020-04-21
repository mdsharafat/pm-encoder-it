<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('emp_id')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->text('note')->nullable();
            $table->float('point')->default(0.00);
            $table->timestamps();
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reviews');
    }
}
