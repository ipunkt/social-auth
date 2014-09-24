<?php namespace Ipunkt\SocialAuth\Provider;


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
} 