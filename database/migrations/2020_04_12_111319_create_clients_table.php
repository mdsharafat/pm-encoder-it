<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();          
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('skype')->nullable();
            $table->unsignedBigInteger('platform_id')->nullable();
            $table->text('desc')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}
