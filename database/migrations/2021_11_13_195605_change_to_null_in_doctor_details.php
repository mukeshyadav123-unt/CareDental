<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('doctor_details', function (Blueprint $table) {
            $table->string('specialty')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->longText('description')->nullable()->change();
            $table->dropIndex('doctor_details_specialty_index');
        });
    }

    public function down()
    {
        Schema::table('doctor_details', function (Blueprint $table) {
            $table->string('specialty')->index()->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->longText('description')->nullable(false)->change();
        });
    }
};
