<?php namespace Ipunkt\SocialAuth;
use Auth;
use Config;
use Exception;
use Hybrid_Auth;
use Hybrid_Endpoint;
use Ipunkt\SocialAuth\Repositories\UserRepository;
use Redirect;
use View;

class SocialLoginController extends \BaseController {
    /**
     * @var Hybrid_Auth
     */
    private $hybrid_auth;
    /**
     * @var UserRepository
     */
    private $user_repository;

	/**
	 * @param UserRepository $user_repository
	 * @param Hybrid_Auth $hybrid_auth
	 */
    public function __construct(UserRepository $user_repository, Hybrid_Auth $hybrid_auth) {
        $this->hybrid_auth = $hybrid_auth;
        $this->user_repository = $user_repository;
    }

	/**
	 * @param $provider_name
	 * @return Response
	 */
    public function login($provider_name) {
        $response = null;
        try {
            $provider = $this->hybrid_auth->authenticate($provider_name);
            $userProfile = $provider->getUserProfile();
            $identifier = $userProfile->identifier;
            $user = $this->user_repository->findByAuth($provider_name, $identifier);
            if( $user !== null ) {
                Auth::login($user);
                $response = Redirect::intended('/');
            } else {
                $response = Redirect::route('social.register', ['provider' => $provider_name]);
            }
        } catch(Exception $e) {
            dd($e);
        }

        return $response;
    }

	/**
	 * Hybridauth endpoint
	 */
    public function auth() {
        Hybrid_Endpoint::process();
        return;
    }

    /**
     * This is an event listener for auth.logout as registered in the SocialAuthServiceProvider
     *
     * Clears known social logins from session upon logging out
     */
    public function logout() {
        $this->hybrid_auth->logoutAllProviders();
    }
}