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
	 * botting the package
	 */
	public function boot() {
		$this->package('ipunkt/social-auth', 'social-auth');
		$this->setRoutes();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->setHybridauth();
		$this->setBinds();

		Event::listen('auth.logout', 'Ipunkt\SocialAuth\SocialLoginController@logout');
		Event::listen('social-auth.register', 'Ipunkt\SocialAuth\EventListeners\UpdateProfileEventListener@register');
		Event::listen('social-auth.attach', 'Ipunkt\SocialAuth\EventListeners\UpdateProfileEventListener@attach');
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
				$providers = \Config::get('social-auth::providers');
				
				foreach($providers as $providerName => &$value) {
					$path = base_path()."/vendor/hybridauth/hybridauth/additional-providers/hybridauth-";
					$path .= strtolower($providerName);

					if(is_dir($path))
						$value = array_merge($value, [
							'wrapper' => array('class' => 'Hybrid_Providers_'.$providerName,
			 				'path' => $path.'/Providers/'.$providerName.'.php')
						]);
				}
					
				$config = [
					'base_url' => route('social.auth'),
					'providers' => $providers,
					'debug_mode' => \Config::get('app.debug'),
					'debug_file' => storage_path().'/logs/laravel.log',
				];
				return new Hybrid_Auth($config);
			}
		);
	}
}
