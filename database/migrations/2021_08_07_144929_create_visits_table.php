<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->foreignId('doctor_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->foreignId('doctor_time_id')->references('id')->on('doctor_times')->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('price')->default(0);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('visits');
    }
}
