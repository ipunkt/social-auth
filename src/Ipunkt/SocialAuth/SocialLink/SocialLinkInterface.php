<?php


namespace Ipunkt\SocialAuth\SocialLink;


/**
 * Interface SocialLinkInterface
 * @package Ipunkt\SocialAuth\SocialLink
 * 
 * Provides info to a single link for a provider
 */
interface SocialLinkInterface {

	/**
	 * Get the url this link points to
	 * 
	 * @return string
	 */
    function getUrl();

	/**
	 * Get the name of the provider this link belongs to
	 * 
	 * @return string
	 */
    function getName();

	/**
	 * Make a html button for this link
	 * 
	 * @return string
	 */
    function getButton();

	/**
	 * make $inner into a html link to the target of this link
	 * 
	 * @param null $inner
	 * @return string
	 */
    function getLink($inner = null);
}