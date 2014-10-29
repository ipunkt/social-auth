<?php namespace Ipunkt\SocialAuth;

use Hybrid_Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Ipunkt\SocialAuth\Provider\HybridAuthProvider;
use Config;
use Ipunkt\SocialAuth\Repositories\SocialProfileRepository;
use ProviderInterface;

/**
 * Class SocialAuthObject
 * @package Ipunkt\SocialAuth
 * 
 * Provides
 */
class SocialAuthObject implements SocialAuthInterface {
    const REGISTER_INFO_SESSION = 'registerInfo';
	
	/**
	 * @var Hybrid_Auth
	 */
	private $hybridAuth;
	/**
	 * @var SocialProfileRepository
	 */
	private $profileRepository;

	public function __construct(Hybrid_Auth $hybridAuth, SocialProfileRepository $profileRepository) {
		$this->hybridAuth = $hybridAuth;
		$this->profileRepository = $profileRepository;
	}

    /**
     * Sets the RegisterInfoInterface to be received by getRegistration
     * Used internaly
     *
     * @param RegisterInfoInterface $info
     */
    public function setRegistration(RegisterInfoInterface $info) {
        Session::set(self::REGISTER_INFO_SESSION, $info);
    }
    
    /**
     * Returns true if a request to register with a social auth provider is present
     *
     * @return boolean
     */
    public function hasRegistration() {
        return Session::has(self::REGISTER_INFO_SESSION);
    }

    /**
     * If present, returns the RegisterInfoInterface which lets you access the account data
     *
     * @return RegisterInfoInterface|null
     */
    public function getRegistration() {
        Session::keep(self::REGISTER_INFO_SESSION);
        return Session::get(self::REGISTER_INFO_SESSION);
    }

    /**
     * Returns a Collection with registration links for all enabled providers
     *
     * @return SocialLink[]|Collection
     */
    public function getRegistrationLinks() {
        return $this->makeLinks('social.register');
    }

	/**
	 * Returns all enabled provider from the config
	 *
	 * @return ProviderInterface[]
	 */
	public function getProviders() {
		$hybridAuthProviders = $this->hybridAuth->getProviders();
		$providerList = [];
		foreach($hybridAuthProviders as $providerName => $config)
			$providerList[] = $providerName;

		$providers = $this->makeProviders($providerList);

		return $providers;
	}

	/**
	 * Returns only currently connected providers
	 *
	 * @return mixed
	 */
	public function getConnectedProviders() {
		$hybridAuthProviders = $this->hybridAuth->getConnectedProviders();

		$providers = $this->makeProviders($hybridAuthProviders);

		return $providers;
	}

	/**
	 * @param $hybridAuthProviders
	 * @param $providers
	 * @return array
	 */
	protected function makeProviders($hybridAuthProviders) {
		$providers = [];
		
		foreach ( $hybridAuthProviders as $hybridAuthProvider )
			$providers[$hybridAuthProvider] = new HybridAuthProvider($this->profileRepository, $hybridAuthProvider, $this->hybridAuth->getAdapter($hybridAuthProvider));
	
		return $providers;
	}
} 