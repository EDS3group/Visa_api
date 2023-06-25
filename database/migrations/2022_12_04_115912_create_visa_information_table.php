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
        Schema::create('visa_information', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('passport_image');
            $table->string('national_image');
            $table->string('shengen_visa_image')->nullable();
            $table->enum('social_status',['single','marrid']);
            // $table->string('bank_statment_image');
            // $table->string('job_letter_image');
            $table->string('family_id_image')->nullable();;
            $table->unsignedBigInteger('visa_id')->onDelete('cascade');
            $table->foreign('visa_id')->references('id')->on('visas');
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
        Schema::dropIfExists('visa_information');
    }
};
