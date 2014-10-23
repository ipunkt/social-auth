<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLoginsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('social_profiles', function($table) {
			$table->string('profile_url')->nullable();
			$table->string('website_url')->nullable();
			$table->string('photo_url')->nullable();
			$table->string('display_name')->nullable();
			$table->string('description')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('gender')->nullable();
			$table->string('language')->nullable();
			$table->string('age')->nullable();
			$table->integer('birth_day')->nullable();
			$table->integer('birth_month')->nullable();
			$table->integer('birth_year')->nullable();
			$table->string('email')->nullable();
			$table->string('verified_email')->nullable();
			$table->string('phone')->nullable();
			$table->string('address')->nullable();
			$table->string('country')->nullable();
			$table->string('region')->nullable();
			$table->string('city')->nullable();
			$table->string('zip')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('social_profiles', function($table) {
			$table->dropColumn('profile_url');
			$table->dropColumn('website_url');
			$table->dropColumn('photo_url');
			$table->dropColumn('display_name');
			$table->dropColumn('description');
			$table->dropColumn('first_name');
			$table->dropColumn('last_name');
			$table->dropColumn('gender');
			$table->dropColumn('language');
			$table->dropColumn('age');
			$table->dropColumn('birth_day');
			$table->dropColumn('birth_month');
			$table->dropColumn('birth_year');
			$table->dropColumn('email');
			$table->dropColumn('verified_email');
			$table->dropColumn('phone');
			$table->dropColumn('address');
			$table->dropColumn('country');
			$table->dropColumn('region');
			$table->dropColumn('city');
			$table->dropColumn('zip');
		});
	}

}
