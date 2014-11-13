<?php namespace Ipunkt\SocialAuth;

use App;
use Event;
use Hybrid_User_Profile;
use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\Profile\ProfileGetInterface;
use Ipunkt\SocialAuth\Profile\ProfileInterface;
use Ipunkt\SocialAuth\Provider\ProviderInterface;
use Ipunkt\SocialAuth\Repositories\SocialLoginRepository;

/**
 * Class ProfileRegisterInfo
 * @package Ipunkt\SocialAuth
 *
 * This object provides a link to a social-auth login for the registration process.
 * It is created by SocialRegisterController and flashed back to the register page set in the config, it provides an
 * interface to the info in the profile.
 * On successful registration of the new user calling success(newUser) on this object will attach the social-auth user
 * to the user on this system
 * On failure to register calling fail() will 'logout' the social-auth user
 */
class RegisterInfo implements RegisterInfoInterface {
    /**
     * @var string
     */
    protected $provider;

	/**
	 * @var ProfileInterface
	 */
	protected $profile;

    /**
     * @param $provider
     */
    public function setProvider($provider) {
        $this->provider = $provider;
    }
	
	public function getInfo($info) {
		$value = null;
		
		$profile = $this->getProfile();
		$method = camel_case('get_'.$info);
		
		if(method_exists($profile,$method))
			$value = $profile->$method();
			
		return $value;
	}

	/**
	 * @return ProfileGetInterface
	 */
	public function getProfile() {
		if(!$this->profileIsSet()) {
			$this->makeProfile();
		}
		
		return $this->profile;
	}

    /**
     * Notify the provider of the RegisterInfo that the user was now successfuly registered.
     *
     * Attaches the social-auth user to the newly created user
     */
    public function success(UserInterface $user) {
        $repository = App::make('Ipunkt\SocialAuth\Repositories\SocialLoginRepository');
        /**
         * @var SocialLoginRepository $repository
         */
	    $profile = $this->getProfile();
	    
        $login = $repository->create();
	    
        $login->setIdentifier($profile->getIdentifier());
        $login->setProvider($this->provider);
        $login->setUser($user->getAuthIdentifier());
	    
        $success = $repository->save($login);
	    if($success)
		    Event::fire('social-auth.register', ['user' => $user, 'registerInfo' => $this]);
	    
	    return $success;
    }

    /**
     * This function returns true if calling success with the created user will create a way to log in to this user
     * This is mainly ment to hide the password field for socialauth logins.
     *
     * @return boolean
     */
    public function providesLogin() {
        return true;
    }

	/**
	 * @return ProviderInterface|null
	 */
	protected function searchProviderByName($providerName) {
		$provider = null;
		
		foreach ( SocialAuth::getConnectedProviders() as $connected_provider ) {
			if ( $providerName == $connected_provider->getIdentifier() ) {
				$provider = $connected_provider;
				break;
			}
		}
		
		return $provider;
	}


	protected function profileIsSet() {
		return ($this->profile !== null);
	}

	protected function makeProfile() {
		$profile = null;
		$provider = $this->searchProviderByName($this->provider);

		if ( $provider !== null )
			$this->profile = $provider->getProfile();
	}

	/**
	 * Direct serialization.
	 * Prevents the complex profile from being serialized, as it will be rebuilt using the active Provider connection of
	 * the provider
	 * 
	 * @return array()
	 */
	public function __sleep() {
		return ['provider'];
	}
} 