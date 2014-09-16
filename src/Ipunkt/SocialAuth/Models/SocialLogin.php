<?php namespace Ipunkt\SocialAuth;


use Config;
use \Eloquent;
use Illuminate\Auth\UserInterface;

/**
 * Class SocialLogin
 * @property string provider
 * @property string identifier
 * @property UserInterface user
 * @package Ipunkt\SocialAuth
 *
 */
class SocialLogin extends Eloquent implements SocialLoginInterface {
    /**
     * @var string
     */
    protected $table = "social_logins";

    /**
     * @var array
     */
    protected $fillable = [];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        $model = Config::get('auth.model');
        return $this->belongsTo($model, 'user_id');
    }

    /**
     * get the name of the provider this social login connects with
     *
     * return string
     */
    public function getProvider() {
        return $this->provider;
    }

    /**
     * Get the Identifier this user has on the provider
     *
     * @return string
     */
    public function getIdentifier() {
        return $this->identifier;
    }

    /**
     * Get the user which is identified by this identifier on this provider
     *
     * @return UserInterface|null
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set the given
     *
     * @param string $provider_name
     */
    public function setProvider($provider_name) {
        $this->provider = $provider_name;
    }

    /**
     * Set identifier to the given string
     *
     * @param string $identifier
     */
    public function setIdentifier($identifier) {
        $this->identifier = $identifier;
    }

    /**
     * Set user by id
     *
     * @param int $id
     */
    function setUser($id) {
        $this->user_id = $id;
    }


}
