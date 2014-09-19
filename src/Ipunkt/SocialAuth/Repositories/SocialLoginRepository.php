<?php namespace Ipunkt\SocialAuth\Repositories;


use Ipunkt\SocialAuth\SocialLoginInterface;

interface SocialLoginRepository {
    /**
     * return SocialLogin by id or null if not found
     *
     * @param int $id
     * @return SocialLoginInterface|null
     */
    function find($id);

    /**
     * find SocialLogin by id or throw exception if not found
     *
     * @param int $id
     * @return SocialLoginInterface|null
     */
    function findOrFail($id);

    /**
     * return SocialLogin by the name of the provider and the identifier this provider has given for the user, or null
     * if not found
     *
     * @param string $provider
     * @param string $identifier|null
     */
    function findByAuth($provider, $identifier);

    /**
     * @return SocialLoginInterface
     */
    function create();

    /**
     *
     * @return boolean
     */
    function save(SocialLoginInterface $login);
}