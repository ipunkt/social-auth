<?php namespace Ipunkt\SocialAuth;

use Hybrid_Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Ipunkt\SocialAuth\Provider\HybridAuthProvider;
use Ipunkt\SocialAuth\SocialLink\SocialLink;
use \Config;
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

	public function __construct(Hybrid_Auth $hybridAuth) {
		$this->hybridAuth = $hybridAuth;
	}

    /**
     * Sets the RegisterInfoInterface to be received by getRegisteration
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
    public function hasRegisteration() {
        return Session::has(self::REGISTER_INFO_SESSION);
    }

    /**
     * If present, returns the RegisterInfoInterface which lets you access the account data
     *
     * @return RegisterInfoInterface|null
     */
    public function getRegisteration() {
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
     * Returns a Collection with attach links for all enabled providers
     *
     * @return SocialLink[]|Collection
     */
    public function getAttachLinks() {
        return $this->makeLinks('social.attach');
    }

    /**
     * Returns a Collection with login links for all enabled providers
     *
     * @return SocialLink[]|Collection
     */
    public function getLoginLinks() {
        return $this->makeLinks('social.login');
    }

    /**
     * Helper function which
     * 
     * @param $route
     * @return array
     */
    protected function makeLinks($route) {
        $links = [];

        $providers = Config::get('social-auth::providers');
        foreach($providers  as $provider_name => $values) {
            if(array_key_exists('enabled', $values) && $values['enabled']) {
                $link = new SocialLink();
    
                $link->name = $provider_name;
                $link->url = route($route, $provider_name);
    
                if(array_key_exists('image', $values))
                    $links->image = $values['image'];
    
                $links[] = $link;
            }
        }

        return $links;
    }

	/**
	 * Returns all enabled provider from the config
	 *
	 * @return ProviderInterface[]
	 */
	public function getProviders() {
		$hybridAuthProviders = $this->hybridAuth->getProviders();

		$providers = $this->makeProviders($hybridAuthProviders);

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
			$providers[] = new HybridAuthProvider($this->hybridAuth->getAdapter($hybridAuthProvider));
		
		return $providers;
	}
} 