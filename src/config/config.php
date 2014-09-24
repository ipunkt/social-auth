<?php
/**
 * Created by PhpStorm.
 * UserInterface: sven
 * Date: 14.05.14
 * Time: 12:34
 */
return [
	/**
	 * This route is used to send the user back to your registration process after logging into their provider account.
	 * 
	 * Set it to your login form and grab the account data via SocialAuth::getRegistration() from there.
	 */
    'register_route' => 'auth.user.create',

	/**
	 * This is used to set up delete cascading in the migration.
	 * Set it to the name of your users table.
	 * 
	 * - If you use the ipunkt/auth package you can leave this at null, the package will use the auth package configuration
	 * - If you do not use ipunkt/auth and leave this at null no delete cascading will be set up in the migration. This means
	 *      deleting a user will leave stale local_user <-> provider_user records will stay in the database
	 */
    'user_table' => null,

	/**
	 * List of providers with their credentials.
	 * 
	 * Your users will be able to register, attach and login with any Provider listed here with enabled = true
	 */
    'providers' => [
	    'Facebook' => [
		    'enabled' => true,
		    'keys' => ['id' => 'Facebookid', 'secret' => 'supersecretkey'],
	    ],
	    'Twitter' => [
		    'enabled' => false,
		    'keys' => ['key' => 'Twitterid', 'secret' => 'evenmoresecretkey'],
	    ],
	    'Github' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Google' => [
		    "enabled" => false,
		    "keys" => [ "id" => "PUT_YOURS_HERE", "secret" => "PUT_YOURS_HERE" ],
		    "scope" => "https://www.googleapis.com/auth/userinfo.profile ". // optional
						"https://www.googleapis.com/auth/userinfo.email" , // optional
		    "access_type" => "offline", // optional
		    "approval_prompt" => "force", // optional
		    //"hd" => "domain.com" // optional
	    ],
	    'Yahoo' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    // Windows Live
	    'Live' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'LinkedIn' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Foursquare' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'LastFM' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Vimeo' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Viadeo' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Identica' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Tumblr' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Goodreads' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'QQ' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Sina' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Murmur' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Pixnet' => [
		    'enabled' => false,
		    'keys' => ['key' => '', 'secret' => ''],
	    ],
	    'Plurk' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Skyrock' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Geni' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'FamilySearch' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'MyHeritage' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    // 500px
	    'px500' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Vkontakte' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Mail.ru' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Yandex' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Odnoklassniki' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Instagram' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'TwitchTV' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
	    'Steam' => [
		    'enabled' => false,
		    'keys' => ['id' => '', 'secret' => ''],
	    ],
    ],
];
