<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::table('doctor_times', function (Blueprint $table) {
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::table('doctor_times', function (Blueprint $table) {
			$table->dropSoftDeletes();
		});
	}
};
