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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->string('center_apply');
            $table->date('date');
            $table->string('country');
            $table->integer('travelers_number')->default(1);
            $table->string('relation')->nullable();
            $table->string('coupon')->nullable();
            $table->float('total_price');
            $table->string('sponsor_name');//
            $table->string('bank_statment_image');//
            $table->string('job_letter_image');//
            $table->unsignedBigInteger('user_id')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status',['accept', 'cancel', 'finished','in_progress','pending'])->default('pending');
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
        Schema::dropIfExists('visas');
    }
};
