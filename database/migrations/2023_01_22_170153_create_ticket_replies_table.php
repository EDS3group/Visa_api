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
        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->unsignedBigInteger('problem_ticket_id')->onDelete('cascade');
            $table->foreign('problem_ticket_id')->references('id')->on('problem_tickets');
            $table->enum('sender_type',['Admin','User']);
            $table->bigInteger('sender_id');
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
        Schema::dropIfExists('ticket_replies');
    }
};
