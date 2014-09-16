<?php namespace Ipunkt\SocialAuth;

use App;
use Hybrid_User_Profile;
use Illuminate\Auth\UserInterface;
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
class ProfileRegisterInfo implements RegisterInfoInterface {
    /**
     * @var Hybrid_User_Profile
     */
    protected $profile;

    /**
     * @var string
     */
    protected $provider;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @param $provider
     */
    function setProvider($provider) {
        $this->provider = $provider;
    }

    /**
     * @param $identifier
     */
    function setIdentifier($identifier) {
        $this->identifier = $identifier;
    }

    /**
     * @param $profile
     */
    function setInfo($profile) {
        $this->profile = $profile;
    }

    /**
     * Query the info for a specific value
     *
     * @param string $info_name
     * @return mixed
     */
    function getInfo($info_name) {
        $value = null;
        if($info_name == 'provider')
            $value = $this->provider;
        else if(property_exists($this->profile, $info_name))
            $value = $this->profile->$info_name;
        return $value;
    }

    /**
     * Notify the provider of the RegisterInfo that the user was now successfuly registered.
     *
     * Attaches the social-auth user to the newly created user
     */
    function success(UserInterface $user) {
        $repository = App::make('Ipunkt\SocialAuth\Repositories\SocialLoginRepository');
        /**
         * @var SocialLoginRepository $repository
         */
        $login = $repository->create();
        $login->setIdentifier($this->identifier);
        $login->setProvider($this->provider);
        $login->setUser($user->getAuthIdentifier());
        return $repository->save($login);
    }

    /**
     * Notify the provider of the RegisterInfo that registering the user has failed.
     *
     * Logs out the user
     */
    function fail() {
    }

    /**
     * This function returns true if calling success with the created user will create a way to log in to this user
     * This is mainly ment to hide the password field for socialauth logins.
     *
     * @return boolean
     */
    function providesLogin() {
        return true;
    }


} 