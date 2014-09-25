<?php


namespace Ipunkt\SocialAuth;
use Illuminate\Support\Collection;
use Ipunkt\SocialAuth\Composers\SocialLink;
use ProviderInterface;


/**
 * Interface SocialAuthInterface
 * @package Ipunkt\SocialAuth
 * 
 * Provides Access to the third party accounts a user is logged in with
 */
interface SocialAuthInterface {
    /**
     * Sets the RegisterInfoInterface to be received by getRegisteration
     * Used internaly
     * 
     * @param RegisterInfoInterface $info
     */
    function setRegistration(RegisterInfoInterface $info);
    
    /**
     * Returns true if a request to register with a social auth provider is present
     * 
     * @return boolean
     */
    function hasRegistration();

    /**
     * If present, returns the RegisterInfoInterface which lets you access the account data
     * 
     * @return RegisterInfoInterface|null
     */
    function getRegistration();

	/**
	 * Returns all enabled provider from the config
	 * 
	 * @return ProviderInterface[]
	 */
	function getProviders();

	/**
	 * Returns only currently connected providers
	 * 
	 * @return mixed
	 */
	function getConnectedProviders();
} 