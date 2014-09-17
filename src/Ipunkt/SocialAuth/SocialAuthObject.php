<?php namespace Ipunkt\SocialAuth;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Ipunkt\SocialAuth\Composers\SocialLink;
use \Config;

/**
 * Class SocialAuthObject
 * @package Ipunkt\SocialAuth
 * 
 * Provides
 */
class SocialAuthObject implements SocialAuthInterface {
    const REGISTER_INFO_SESSION = 'registerInfo';

    /**
     * Sets the RegisterInfoInterface to be received by getRegisteration
     * Used internaly
     *
     * @param RegisterInfoInterface $info
     */
    function setRegistration(RegisterInfoInterface $info) {
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

        $full_config = Config::get('social-auth::hybridauth');
        $providers = $full_config['providers'];
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
} 