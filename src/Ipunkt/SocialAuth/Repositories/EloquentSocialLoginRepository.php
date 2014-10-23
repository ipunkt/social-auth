<?php namespace Ipunkt\SocialAuth\Repositories;

use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\SocialProfile;
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
     * return SocialProfile by id or null if not found
     *
     * @param int $id
     * @return SocialLoginInterface|null
     */
    public function find($id) {
        return SocialProfile::find($id);
    }

    /**
     * find SocialProfile by id or throw exception if not found
     *
     * @param int $id
     * @return SocialLoginInterface|null
     */
    public function findOrFail($id) {
        return SocialProfile::findOrFail($id);
    }

    /**
     * return SocialProfile by the name of the provider and the identifier this provider has given for the user, or null
     * if not found
     *
     * @param string $provider
     * @param string $identifier |null
     */
    public function findByAuth($provider, $identifier) {
        return SocialProfile::where('provider', '=', $provider)->whereIdentifier($identifier)->first();
    }

    /**
     * @return SocialLoginInterface
     */
    public function create() {
        return new SocialProfile();
    }

    /**
     *
     * @return boolean
     */
    public function save(SocialLoginInterface $login) {
        /**
         * @var SocialProfile $login
         */
        return $login->save();
    }

	/**
	 * Attempt to find the Profile of User $user with provider $providerName
	 *
	 * @param UserInterface $user
	 * @param string $providerName
	 * @return mixed
	 */
	function findByUserAndProvider(UserInterface $user, $providerName) {
		return SocialProfile::where('provider', '=', $providerName)->whereUserId($user->getAuthIdentifier())->first();
	}


} 