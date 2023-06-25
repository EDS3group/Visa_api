<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('nationality');
            $table->string('mode_of_finance');
            $table->string('major_of_study');
            $table->string('qualification');
            $table->string('grade');
            $table->time('call_from');
            $table->time('call_to');
            $table->unsignedBigInteger('user_id')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status',['accept','cancel','finished','in_progress','pending'])->default('pending');

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
        Schema::dropIfExists('schools');
    }
};
