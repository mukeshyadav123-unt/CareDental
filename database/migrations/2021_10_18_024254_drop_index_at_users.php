<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropIndex('users_phone_number_unique');
		});
	}

	public function down()
	{
		Schema::table('users', function (Blueprint $table) {
			$table->unique('phone_number');
		});
	}
};
