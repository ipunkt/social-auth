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
	public function socialProfile() {
		return $this->hasOne('SocialProfile')->whereProvider('UserProfile');
	}

	/**
	 * @return ProfileInterface
	 */
	public function getProfile() {
		return $this->socialProfile;
	}
} 