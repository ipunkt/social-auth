<?php


namespace Ipunkt\SocialAuth\Profile;


/**
 * Interface HasProfileInterface
 * @package Ipunkt\SocialAuth\Profile
 */
interface HasProfileInterface {
	/**
	 * Returns the active profile
	 * 
	 * @return ProfileInterface
	 */
	function getProfile($providerName = 'UserProfile');
} 