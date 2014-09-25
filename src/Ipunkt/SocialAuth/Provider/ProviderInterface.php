<?php namespace Ipunkt\SocialAuth\Provider;
use Ipunkt\SocialAuth\Profile\ProfileInterface;


/**
 * Interface ProviderInterface
 * 
 * Provides info about a provider
 */
interface ProviderInterface {

	/**
	 * Returns true if the current user is currently logged in through this provider
	 * 
	 * @return bool
	 */
	function isLoggedIn();

	/**
	 * Get the name of this provider as set in the config file
	 * 
	 * @return string
	 */
	function getIdentifier();
	
	/**
	 * Returns the natural name of the this provider
	 * 
	 * @return string
	 */
	function getName();

	/**
	 * @return ProfileInterface
	 */
	function getProfile();

	/**
	 * Returns an html link which will let the user log in through this provider
	 *
	 * @param $innerHtml
	 * @return string
	 */
	function loginLink($innerHtml);

	/**
	 * Returns an html link which will let the logged in user attach an account from this provider
	 * 
	 * @param $innerHtml
	 * @return mixed
	 */
	function attachLink($innerHtml);

	/**
	 * Returns an html link which will let the user register using an account from this provider
	 * 
	 * @param $innerHtml
	 * @return mixed
	 */
	function registerLink($innerHtml);
} 