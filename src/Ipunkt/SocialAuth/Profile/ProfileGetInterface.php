<?php namespace Ipunkt\SocialAuth\Profile;
use Ipunkt\SocialAuth\Provider\ProviderInterface;


/**
 * Interface ProfileGetInterface
 * 
 * Provides access to the profile of a user who is logged in through a provider
 * It is styled after Hybrid_User_Profile, as the first implementation will be a simple wrapper around it.
 */
interface ProfileGetInterface {
	/**
	 * @return ProviderInterface
	 */
	function getProvider();
	
	/**
	 * @return string
	 */
	function getIdentifier();

	/**
	 * @return string
	 */
	function getProfileUrl();

	/**
	 * @return string
	 */
	function getWebsiteUrl();

	/**
	 * @return string
	 */
	function getPhotoUrl();

	/**
	 * @return string
	 */
	function getDisplayName();

	/**
	 * @return string
	 */
	function getDescription();

	/**
	 * @return string
	 */
	function getFirstName();

	/**
	 * @return string
	 */
	function getLastName();

	/**
	 * @return string
	 */
	function getGender();

	/**
	 * @return string
	 */
	function getLanguage();

	/**
	 * @return string
	 */
	function getAge();

	/**
	 * @return string
	 */
	function getBirthDay();

	/**
	 * @return string
	 */
	function getBirthMonth();

	/**
	 * @return string
	 */
	function getBirthYear();

	/**
	 * @return string
	 */
	function getEmail();

	/**
	 * @return string
	 */
	function getVerifiedEmail();

	/**
	 * @return string
	 */
	function getPhone();

	/**
	 * @return string
	 */
	function getAddress();

	/**
	 * @return string
	 */
	function getCountry();

	/**
	 * @return string
	 */
	function getRegion();

	/**
	 * @return string
	 */
	function getCity();

	/**
	 * @return string
	 */
	function getZip();
} 