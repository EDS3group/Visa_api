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
        Schema::create('book_matches', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('match_id')->onDelete('cascade');
            $table->foreign('match_id')->references('id')->on('team_matches');
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
        Schema::dropIfExists('book_matches');
    }
};
