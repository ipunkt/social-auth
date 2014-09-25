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
	/**
	 * @var
	 */
	private $providerName;

	/**
	 * @param $providerName
	 * @param Hybrid_Provider_Adapter $adapter
	 */
	public function __construct($providerName, Hybrid_Provider_Adapter $adapter) {
		$this->adapter = $adapter;
		$this->providerName = $providerName;
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
		return $this->providerName;
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

	/**
	 * Returns an html link which will let the user log in through this provider
	 *
	 * @param $innerHtml
	 * @return string
	 */
	public function loginLink($innerHtml) {
		return $this->makeLink('social.login', $innerHtml);
	}

	/**
	 * Returns an html link which will let the logged in user attach an account from this provider
	 *
	 * @param $innerHtml
	 * @return mixed
	 */
	public function attachLink($innerHtml) {
		return $this->makeLink('social.attach', $innerHtml);
	}

	/**
	 * Returns an html link which will let the user register using an account from this provider
	 *
	 * @param $innerHtml
	 * @return mixed
	 */
	public function registerLink($innerHtml) {
		return $this->makeLink('social.register', $innerHtml);
	}


	protected function makeLink($route, $innerHtml) {
		return '<a href="'.route($route, $this->providerName).'">'.$innerHtml.'</a>';
	}
} 