<?php namespace Ipunkt\SocialAuth;

use Illuminate\Support\Facades\Facade;

/**
 * Class SocialAuth
 * @package Ipunkt\SocialAuth
 * 
 * Facade to the SocialAuthInterface
 */
class SocialAuth extends Facade {
    protected static function getFacadeAccessor() {
        return 'Ipunkt\SocialAuth\SocialAuthInterface';
    }

} 