<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropColumn(['seen']);
            $table->boolean('seen_by_doctor')->default(0);
            $table->boolean('seen_by_patient')->default(0);
            $table->boolean('seen_by_admin')->default(0);
        });
    }

    public function down()
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->boolean('seen')->default(0);
            $table->dropColumn([
                'seen_by_doctor',
                'seen_by_patient',
                'seen_by_admin',
            ]);
        });
    }
};
