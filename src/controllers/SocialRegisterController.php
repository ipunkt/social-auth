<?php namespace Ipunkt\SocialAuth;

use App;
use Auth;
use Config;
use Hybrid_Auth;
use Ipunkt\SocialAuth\Repositories\SocialLoginRepository;
use Ipunkt\SocialAuth\Repositories\UserRepository;
use Redirect;
use Session;
use View;

/**
 * Class SocialRegisterController
 * @package Ipunkt\SocialAuth
 *
 * Controls registering a user via a social-auth service
 */
class SocialRegisterController extends \BaseController {

    /**
     * @var SocialLoginRepository
     */
    private $login_repository;
	
    /**
     * @var Repositories\UserRepository
     */
    private $user_repository;
	
    /**
     * @var \Hybrid_Auth
     */
    private $hybrid_auth;

    /**
     * @param SocialLoginRepository $login_repository
     * @param UserRepository $user_repository
     * @param Hybrid_Auth $hybrid_auth
     */
    public function __construct(SocialLoginRepository $login_repository, UserRepository $user_repository, Hybrid_Auth $hybrid_auth) {

        $this->login_repository = $login_repository;
        $this->user_repository = $user_repository;
        $this->hybrid_auth = $hybrid_auth;
    }

    /**
     * Prompt the User to authenticate with a social-auth provider
     *
     * @param $provider_name
     * @param null $profile
     * @return null
     */
    public function auth($provider_name, &$profile = null) {
        $identifier = null;
        try {
            $provider = $this->hybrid_auth->authenticate($provider_name);
            $userProfile = $provider->getUserProfile();
            $identifier = $userProfile->identifier;
            $profile = $userProfile;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return $identifier;
    }

    /**
     * Check if we already have a user attached to $identifer on $provider_name
     * returns true if there is a user attached, false otherwise
     *
     * @param $provider_name
     * @param $identifier
     * @return bool
     */
    public function checkRegistered($provider_name, $identifier) {
        $user = $this->user_repository->findbyAuth($provider_name, $identifier);
        return ($user !== null);
    }

    /**
     * Attempt to login to a social-auth provider
     * If successful, attach the social-auth user to the currently logged in user on this system
     *
     * @param $provider_name
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function attach($provider_name) {
        $response = null;


        $profile = null;
        $identifier = $this->auth($provider_name, $profile);
        if(!$this->checkRegistered($provider_name, $identifier)) {

            $id = Auth::user()->getAuthIdentifier();

            $login = $this->login_repository->create();
            $login->setProvider($provider_name);
            $login->setIdentifier($identifier);
            $login->setUser($id);

            if($this->login_repository->save($login)) {
                $response = Redirect::back()->with(['message' => trans('social-auth::user.account attach success',
                    ['provider' => $provider_name, 'accountname' => $profile->displayName])]);
            } else {
                $response = Redirect::back()->withErrors(['message' => trans('social-auth::user.account attach fail', ['accoutnname' => $profile->displayName])]);
            }

        } else {
            $response = Redirect::back()->withErrors(['message' => trans('social-auth::user.account already registered', ['accountname' => $profile->displayName]) ]);
        }

        return $response;
    }

    /**
     * Login into a social-auth account intending to register a new user with it
     * It is considered successful if the user logs into the social-auth account and the account is not yet attached to
     * a different Account on this system.
     *
     * If Successful it will redirect back to the register page as set in the config and flash a new
     * registerInfo => ProfileRegisterInfo object to the register page.
     * On successful registration it is necessary to call registerInfo->success(newUser) to actualy attach the social-auth
     * user to the newly registered user
     *
     * @see ProfileRegisterInfo
     * @param $provider_name
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function register($provider_name) {
        $response = null;

        $profile = null;
        $route = Config::get('social-auth::register route');
        $identifier = $this->auth($provider_name, $profile);
        if(!$this->checkRegistered($provider_name, $identifier)) {
            $register_info = App::make('Ipunkt\SocialAuth\ProfileRegisterInfo');
            /**
             * @var ProfileRegisterInfo $register_info
             */
            $register_info->setProvider($provider_name);
            $register_info->setIdentifier($identifier);
            $register_info->setInfo($profile);
            
            SocialAuth::setRegistration($register_info);
            
            $response = Redirect::route($route);
        } else {
            $response = Redirect::route($route)->withErrors(['message' => trans('social-auth::user.account already registered', ['accountname' => $profile->displayName]),
                ['accountname' => $profile->displayName]]);
        }

        return $response;
    }
}
