<?php namespace Ipunkt\SocialAuth\Repositories;

use Ipunkt\SocialAuth\Profile\ProfileInterface;

interface SocialProfileRepository {
	/**
	 * @param $provider
	 * @param $identifier
	 * @return ProfileInterface
	 */
	function findByAuth($provider, $identifier);
} 