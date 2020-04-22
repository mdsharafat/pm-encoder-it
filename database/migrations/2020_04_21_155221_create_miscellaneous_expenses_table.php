<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMiscellaneousExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miscellaneous_expenses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->text('name')->nullable();
            $table->integer('amount')->nullable();
            $table->date('date')->nullable();
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
        Schema::drop('miscellaneous_expenses');
    }
}
