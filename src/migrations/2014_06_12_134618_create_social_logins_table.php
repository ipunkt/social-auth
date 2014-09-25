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
		Schema::create('social_logins', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('provider');
            $table->text('identifier');

            if(Config::has('social-auth::user_table')) {
                $user_table = Config::get('social-auth::user_table');
                if($user_table === null)
                    $user_table = Config::get('auth::user_table.table_name');
                $id = 'id';
                if(Config::has('social-auth::user_table_id'))
                    $id = Config::get('social-auth::user_table_id');
                $table->foreign('user_id')->references($id)->on($user_table)->onDelete('cascade');
            }
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('social_logins');
	}

}
