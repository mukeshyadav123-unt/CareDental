<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientContactInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_contact_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('home_phone_number')->nullable();
            $table->string('work_phone_number')->nullable();
            $table->text('address')->nullable();
            $table->text('temp_address')->nullable();
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
        Schema::dropIfExists('patient_contact_information');
    }
}
