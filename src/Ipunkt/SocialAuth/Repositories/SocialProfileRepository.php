<?php namespace Ipunkt\SocialAuth\Repositories;

use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\Profile\ProfileInterface;

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
} 