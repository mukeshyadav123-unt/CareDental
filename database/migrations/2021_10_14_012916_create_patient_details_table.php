<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('preferred_first_name')->default('Not Entered');
            $table->string('race')->default('Not Entered');
            $table->string('ethnic_background')->default('Not Entered');
            $table->string('religion')->default('Not Entered');
            $table->string('marital_status')->default('Not Entered');
            $table->string('ethnicity')->default('Not Entered');
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
        Schema::dropIfExists('patient_details');
    }
}
