<?php namespace Ipunkt\SocialAuth\Repositories;

use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\Profile\ProfileInterface;
use Ipunkt\SocialAuth\Profile\ProfileSetInterface;

interface SocialProfileRepository {
	/**
	 * @param $provider
	 * @param $identifier
	 * @return ProfileInterface
	 */
	function findByAuth($provider, $identifier);

	/**
	 * Attempt to find the Profile of User $user with provider $providerName
	 * 
	 * @param UserInterface $user
	 * @param string $providerName
	 * @return mixed
	 */
	function findByUserAndProvider(UserInterface $user, $providerName);

	/**
	 * Attempt to save the profile to the database
	 * 
	 * @param ProfileSetInterface $profile
	 * @return bool
	 */
	function saveProfile(ProfileSetInterface $profile);
} 