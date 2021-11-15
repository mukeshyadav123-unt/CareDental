<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->after('doctor_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->change();
            $table->foreignId('patient_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn('admin_id');
        });
    }
};
