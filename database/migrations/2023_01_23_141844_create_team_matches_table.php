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
        Schema::create('team_matches', function (Blueprint $table) {
            $table->id();
            $table->string('champion_name_ar');
            $table->string('champion_name_en');
            $table->unsignedBigInteger('first_team')->onDelete('cascade');
            $table->foreign('first_team')->references('id')->on('teams');
            $table->unsignedBigInteger('second_team')->onDelete('cascade');
            $table->foreign('second_team')->references('id')->on('teams');
            $table->string('stadum_name_en');
            $table->string('stadum_name_ar');
            $table->date('date');
            $table->time('time');
            $table->integer('number_of_tickets')->nullable();
            $table->float('ticket_price')->nullable();
            // $table->enum('status',['accept','reject'])->nullable();
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
        Schema::dropIfExists('team_matches');
    }
};
