<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToDoctorDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('doctor_details', function (Blueprint $table) {
            $table->float('price')->after('description')->default(0);
        });
    }

    public function down()
    {
        Schema::table('doctor_details', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
