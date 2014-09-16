<?php


namespace Ipunkt\SocialAuth;


use Illuminate\Auth\UserInterface;

interface RegisterInfoInterface {
    /**
     * Query the info for a specific value
     *
     * @param string $info_name
     * @return mixed
     */
    function getInfo($info_name);

    /**
     * Notify the provider of the RegisterInfo that the user was now successfuly registered.
     */
    function success(UserInterface $user);

    /**
     * Notify the provider of the RegisterInfo that registering the user has failed.
     */
    function fail();

    /**
     * This function returns true if calling success with the created user will create a way to log in to this user
     * This is mainly ment to hide the password field for socialauth logins.
     *
     * @return boolean
     */
    function providesLogin();
}