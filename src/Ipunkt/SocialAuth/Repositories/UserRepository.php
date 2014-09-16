<?php
/**
 * Created by PhpStorm.
 * UserInterface: sven
 * Date: 14.05.14
 * Time: 11:46
 */

namespace Ipunkt\SocialAuth\Repositories;

use Illuminate\Auth\UserInterface;
use Ipunkt\Multiauth\User;

interface UserRepository {
    /**
     * Attempt to find a UserInterface with the given id.
     * returns the UserInterface or null on error
     *
     * @param int $id
     * @return null|User
     */
    public function find($id);

    /**
     * Attempt to find a UserInterface by given login credentials
     * returns the UserInterface or null on error
     *
     * @param array $credentials
     * @return null|User
     */
    public function findByAuth($provider, $identifier);

    /**
     * Attempt to save updates to the User
     *
     * @return boolean
     */
    public function save(UserInterface $user);

}