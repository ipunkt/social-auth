<?php


namespace Ipunkt\SocialAuth\Profile;


/**
 * Class EloquentHasProfile
 * @package Ipunkt\SocialAuth\Profile
 * 
 * Implements the HasProfileInterface for an Eloquent Model.
 * Provides
 * - socialProfile() 1-to-1 relationship
 * - getProfile() implements HasProfileInterface by returning a ProfileInterface
 */
trait EloquentHasProfile {
	/**
	 * @return HasOneRelationship
	 */
	public function socialProfile($providerName) {
		return $this->hasOne('Ipunkt\SocialAuth\SocialProfile')->where('provider', '=', $providerName);
	}

	/**
	 * @return ProfileInterface
	 */
	public function getProfile($providerName = 'UserProvider') {
		return $this->socialProfile($providerName)->first();
	}
} 