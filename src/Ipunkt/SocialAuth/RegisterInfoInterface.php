<?php


namespace Ipunkt\SocialAuth;


use Illuminate\Auth\UserInterface;

/**
 * Interface RegisterInfoInterface
 * @package Ipunkt\SocialAuth
 * 
 * Provides info to a provider account which the user chose to register with
 */
interface RegisterInfoInterface {
	/**
	 * The Unique user's ID on the connected provider. Can be an interger for some providers, Email, URL, etc.
	 */
	const PROFILE_IDENTIFIER = 'identifier';

	/**
	 * URL link to profile page on the IDp web site
	 */
	const PROFILE_URL = 'profileURL';

	/**
	 * User website, blog, web page
	 */
	const PROFILE_WEBSITE_URL = 'webSiteURL';

	/**
	 * URL link to user photo or avatar
	 */
	const PROFILE_PHOTO_URL = 'photoURL';

	/**
	 *  User dispalyName provided by the IDp or a concatenation of first and last name.
	 */
	const PROFILE_DISPLAY_NAME = 'displayName';

	/**
	 * A short about_me
	 */
	const PROFILE_DESCRIPTION = 'description';

	/**
	 * User's first name
	 */
	const PROFILE_FIRST_NAME = 'firstName';

	/**
	 * User's last name
	 */
	const PROFILE_LAST_NAME = 'lastName';

	/**
	 *  User's gender. Values are 'female', 'male' or NULL
	 */
	const PROFILE_GENDER = 'gender';

	/**
	 * User's language
	 */
	const PROFILE_LANGUAGE = 'language';

	/**
	 * User' age, note that we dont calculate it. we return it as is if the IDp provide it
	 */
	const PROFILE_AGE = 'age';

	/**
	 * The day in the month in which the person was born.
	 */
	const PROFILE_BIRTHDAY = 'birthDay';

	/**
	 * The month in which the person was born.
	 */
	const PROFILE_BIRTHMONTH = 'birthMonth';

	/**
	 * The year in which the person was born.
	 */
	const PROFILE_BIRTHYEAR = 'birthYear';

	/**
	 * User email. Not all of IDp garant access to the user email
	 */
	const PROFILE_EMAIL = 'email';

	/**
	 * Verified user email. Note: not all of IDp garant access to verified user email. 
	 */
	const PROFILE_EMAIL_VERIFIED = 'emailVerified';

	/**
	 * User's phone number
	 */
	const PROFILE_PHONE = 'phone';

	/**
	 * User's address
	 */
	const PROFILE_ADDRESS = 'address';

	/**
	 * User's country
	 */
	const PROFILE_COUNTRY = 'country';

	/**
	 *  User's state or region  
	 */
	const PROFILE_REGION = 'region';

	/**
	 * User's city
	 */
	const PROFILE_CITY = 'city';

	/**
	 * Postal code or zipcode.
	 */
	const PROFILE_ZIP = 'zip';
	
    /**
     * Query the info for a specific value
     * use the PROFILE_* constants to choose your information
     *
     * @param string $info_name
     * @return mixed
     */
    function getInfo($info_name);

    /**
     * Notify the provider of the RegisterInfo that the user was now successfuly registered.
     */
    function success(UserInterface $user);

    /**
     * This function returns true if calling success with the created user will create a way to log in to this user
     * This is mainly ment to hide the password field for socialauth logins.
     *
     * @return boolean
     */
    function providesLogin();
}