<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::table('chat_messages', function (Blueprint $table) {
			$table->string('from')->change();
		});
	}

	public function down()
	{
		Schema::table('chat_messages', function (Blueprint $table) {
            $table->enum('from', ['patient', 'doctor']);
        });
	}
};
