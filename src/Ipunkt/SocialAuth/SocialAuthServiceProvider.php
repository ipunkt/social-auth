<?php namespace Ipunkt\SocialAuth;

use App;
use Auth;
use Config;
use Event;
use Hybrid_Auth;
use Illuminate\Support\ServiceProvider;

/**
 * Class SocialAuthServiceProvider
 * @package Ipunkt\SocialAuth
 */
class SocialAuthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * 
	 */
    public function boot() {
        $this->package('ipunkt/social-auth', 'social-auth');
    }

	/**
	 * Register the service provider.

	 * @return void
	 */
	public function register()
	{
		$this->setRoutes();
		$this->setHybridauth();
		$this->setBinds();

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

	protected function setRoutes() {
		require_once __DIR__ . "/../../routes.php";
	}

	protected function setBinds() {
		$this->app->bind('Ipunkt\SocialAuth\Repositories\UserRepository',
			'Ipunkt\SocialAuth\Repositories\EloquentUserRepository');
		$this->app->bind('Ipunkt\SocialAuth\Repositories\SocialLoginRepository',
			'Ipunkt\SocialAuth\Repositories\EloquentSocialLoginRepository');
		$this->app->bind('Ipunkt\SocialAuth\Repositories\SocialProfileRepository',
			'Ipunkt\SocialAuth\Repositories\EloquentSocialLoginRepository');
		$this->app->bind('Ipunkt\SocialAuth\SocialAuthInterface',
			'Ipunkt\SocialAuth\SocialAuthObject');
	}

	/**
	 * @precondition Routes set up for this package.
	 */
	protected function setHybridauth() {
		$this->app->bind('Hybrid_Auth', function () {
				$config = [
					'base_url' => route('social.auth'),
					'providers' => \Config::get('social-auth::providers')
                ];
                return new Hybrid_Auth($config);
            }
		);
	}

}
