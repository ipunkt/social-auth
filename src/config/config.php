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
    ],
];
