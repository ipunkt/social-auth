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
    function hasRegisteration();

    /**
     * If present, returns the RegisterInfoInterface which lets you access the account data
     * 
     * @return RegisterInfoInterface|null
     */
    function getRegisteration();

    /**
     * Returns a Collection with registration links for all enabled providers 
     * 
     * @return SocialLink[]|Collection
     */
    function getRegistrationLinks();

    /**
     * Returns a Collection with attach links for all enabled providers
     *
     * @return SocialLink[]|Collection
     */
    function getAttachLinks();

    /**
     * Returns a Collection with login links for all enabled providers
     *
     * @return SocialLink[]|Collection
     */
    function getLoginLinks();

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