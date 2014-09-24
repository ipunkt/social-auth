<?php namespace Ipunkt\SocialAuth\Provider;

use Hybrid_Provider_Adapter;
use Ipunkt\SocialAuth\Profile\HybridAuthProfile;
use Ipunkt\SocialAuth\Profile\ProfileInterface;

/**
 * Class HybridAuthProvider
 * @package Ipunkt\SocialAuth\Provider
 * 
 * Provides the ProviderInterface for a Hybrid_Auth_Provider
 */
class HybridAuthProvider implements ProviderInterface {

	/**
	 * @var Hybrid_Provider_Adapter
	 */
	private $adapter;

	public function __construct(Hybrid_Provider_Adapter $adapter) {
		$this->adapter = $adapter;
	}

	/**
	 * Returns true if the current user is currently logged in through this provider
	 *
	 * @return bool
	 */
	public function isLoggedIn() {
		return $this->adapter->isUserConnected();
	}

	/**
	 * Get the name of this provider as set in the config file
	 *
	 * @return string
	 */
	public function getIdentifier() {
		// TODO: find identifier from the adapter
		dd($this->adapter->config);
	}

	/**
	 * Returns the natural name of the this provider
	 *
	 * @return string
	 */
	public function getName() {
		return $this->getIdentifier();
	}

	/**
	 * @return ProfileInterface
	 */
	public function getProfile() {
		return new HybridAuthProfile($this->adapter->getUserProfile());
	}


} 