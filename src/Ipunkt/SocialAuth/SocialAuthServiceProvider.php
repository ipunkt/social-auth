<?php namespace Ipunkt\SocialAuth;

use App;
use Auth;
use Config;
use Event;
use Hybrid_Auth;
use Illuminate\Support\ServiceProvider;

class SocialAuthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    public function boot() {
        $this->package('ipunkt/social-auth', 'social-auth');
    }

	/*
	 * Register the service provider.

	 * @return void
	 */
	public function register()
	{
        App::bind('Hybrid_Auth', function() {
                $config = \Config::get('social-auth::hybridauth');
                return new Hybrid_Auth( $config );
            }
        );
        App::bind('Ipunkt\SocialAuth\Repositories\UserRepository',
                'Ipunkt\SocialAuth\Repositories\EloquentUserRepository');
        App::bind('Ipunkt\SocialAuth\Repositories\SocialLoginRepository',
            'Ipunkt\SocialAuth\Repositories\EloquentSocialLoginRepository');
        App::bind('Ipunkt\SocialAuth\SocialAuthInterface',
            'Ipunkt\SocialAuth\SocialAuthObject');
        require_once __DIR__ . "/../../routes.php";

        Event::listen('auth.logout', 'Ipunkt\SocialAuth\SocialLoginController@logout');
	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
