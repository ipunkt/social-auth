<?php namespace Ipunkt\SocialAuth\Repositories;

use Ipunkt\SocialAuth\SocialLogin;
use Ipunkt\SocialAuth\SocialLoginInterface;

/**
 * Class EloquentSocialLoginRepository
 * @package Ipunkt\SocialAuth\Repositories
 * 
 * Since the default database structure has the profile as a single table instead of a 1-to-1 relationship, this repository
 * doubles as both SocialLoginRepository and SocialProfileRepository
 */
class EloquentSocialLoginRepository implements SocialLoginRepository, SocialProfileRepository {
    /**
     * return SocialLogin by id or null if not found
     *
     * @param int $id
     * @return SocialLoginInterface|null
     */
    public function find($id) {
        return SocialLogin::find($id);
    }

    /**
     * find SocialLogin by id or throw exception if not found
     *
     * @param int $id
     * @return SocialLoginInterface|null
     */
    public function findOrFail($id) {
        return SocialLogin::findOrFail($id);
    }

    /**
     * return SocialLogin by the name of the provider and the identifier this provider has given for the user, or null
     * if not found
     *
     * @param string $provider
     * @param string $identifier |null
     */
    public function findByAuth($provider, $identifier) {
        return SocialLogin::where('provider', '=', $provider)->whereIdentifier($identifier)->first();
    }

    /**
     * @return SocialLoginInterface
     */
    public function create() {
        return new SocialLogin();
    }

    /**
     *
     * @return boolean
     */
    public function save(SocialLoginInterface $login) {
        /**
         * @var SocialLogin $login
         */
        return $login->save();
    }

} 