<?php


namespace Ipunkt\SocialAuth\Profile;
use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\Provider\ProviderInterface;


/**
 * Interface ProfileSetInterface
 * @package Ipunkt\SocialAuth\Profile
 * 
 * The saving counterpart to ProfileGetInterface. Intended to backup the profile to the database
 */
interface ProfileSetInterface {
	/**
	 * @param $userid
	 * @return mixed
	 */
	function setUser($userid);
	
	/**
	 * @return ProviderInterface
	 */
	function setProvider($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setIdentifier($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setProfileUrl($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setWebsiteUrl($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setPhotoUrl($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setDisplayName($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setDescription($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setFirstName($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setLastName($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setGender($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setLanguage($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setAge($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setBirthDay($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setBirthMonth($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setBirthYear($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setEmail($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setVerifiedEmail($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setPhone($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setAddress($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setCountry($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setRegion($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setCity($value);

	/**
	 * @param $value
	 * @return null
	 */
	function setZip($value);

	/**
	 * @param ProfileGetInterface $profile
	 * @return mixed
	 */
	function copy(ProfileGetInterface $profile);
} 