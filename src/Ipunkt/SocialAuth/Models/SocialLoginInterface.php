<?php


namespace Ipunkt\SocialAuth;
use Illuminate\Auth\UserInterface;


/**
 * Interface SocialLoginInterface
 * @package Ipunkt\SocialAuth
 *
 * This Interface connects a login provider to a user through the id which the provider sends when the user is logged in
 */
interface SocialLoginInterface {
    /**
     * get the name of the provider this social login connects with
     *
     * return string
     */
    public function getProvider();

    /**
     * Get the Identifier this user has on the provider
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get the user which is identified by this identifier on this provider
     *
     * @return UserInterface|null
     */
    public function getUser();

    /**
     * Set the given
     *
     * @param string $provider_name
     */
    public function setProvider($provider_name);

    /**
     * Set identifier to the given string
     *
     * @param string $identifier
     */
    public function setIdentifier($identifier);

    /**
     * Set user by id
     *
     * @param int $id
     */
    function setUser($id);
}