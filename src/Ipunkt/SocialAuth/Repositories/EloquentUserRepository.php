<?php
/**
 * Created by PhpStorm.
 * User: sven
 * Date: 10.06.14
 * Time: 15:17
 */

namespace Ipunkt\SocialAuth\Repositories;


use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\SocialProfile;

/**
 * Class EloquentUserRepository
 * @package Ipunkt\SocialAuth\Repositories
 * 
 * Eloquent implementation of the UserRepository interface
 */
class EloquentUserRepository implements UserRepository {
    /**
     * @var SocialLoginRepository
     */
    private $repository;

	/**
	 * @param SocialLoginRepository $repository
	 */
    public function __construct(SocialLoginRepository $repository) {

        $this->repository = $repository;
    }
    /**
     * Attempt to find a UserInterface with the given id.
     * returns the UserInterface or null on error
     *
     * @param int $id
     * @return null|User
     */
    public function find($id)
    {
        $model = Config::get('auth.model');
        return $model::find($id);
    }

    /**
     * Attempt to find a UserInterface by given login credentials
     * returns the UserInterface or null on error
     *
     * @param array $credentials
     * @return null|User
     */
    public function findByAuth($provider, $identifier) {
        $user = null;

        $login = $this->repository->findByAuth($provider, $identifier);

        if($login !== null)
            $user = $login->getUser();

        return $user;
    }

    /**
     * Attempt to save updates to the User
     *
     * @return boolean
     */
    public function save(UserInterface $user) {
        $user->save();
    }


}