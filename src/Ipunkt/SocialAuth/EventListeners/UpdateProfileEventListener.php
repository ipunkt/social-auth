<?php namespace Ipunkt\SocialAuth\EventListeners;
use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\Profile\HasProfileInterface;
use Ipunkt\SocialAuth\Profile\ProfileGetInterface;
use Ipunkt\SocialAuth\RegisterInfoInterface;
use Ipunkt\SocialAuth\Repositories\SocialProfileRepository;
use Ipunkt\SocialAuth\SocialLoginInterface;

/**
 * Class UpdateProfileEventListener
 * 
 * This listener takes care of updating the profile on registering through a social-auth provider or attaching the first
 * social-auth provider to an existing account
 */
class UpdateProfileEventListener {

	/**
	 * @var SocialProfileRepository
	 */
	private $socialProfileRepository;

	/**
	 * @param SocialProfileRepository $socialProfileRepository
	 */
	public function __construct(SocialProfileRepository $socialProfileRepository) {

		$this->socialProfileRepository = $socialProfileRepository;
	}

	/**
	 * Listens for:
	 * User has just registered a new account through a social-auth provider.
	 * Does:
	 * Create the 'UserProfile' DatabaseProfile for the new account using the Profile of the provider just registered with
	 * 
	 * @param $parameters
	 */
	public function register(UserInterface $user, RegisterInfoInterface $registerInfo) {
		
		$database_profile = $this->socialProfileRepository->findByUserAndProvider($user, 'UserProfile');
		if($database_profile === null) {
			$database_profile = $this->socialProfileRepository->create();
			$database_profile->setProvider('UserProfile');
			$database_profile->setIdentifier($user->getAuthIdentifier());
			$this->socialProfileRepository->saveProfile($database_profile);
		}
	}

	/**
	 * Listens for:
	 * User has just attached a new social-auth provider to his existing account.
	 * Does:
	 * Checks if this is the first provider to get attached to the user. If so, create or fill the DatabaseProfile using
	 * the info from this provider.
	 * 
	 * @param $parameters
	 */
	public function attach($parameters) {
		/**
		 * @var HasProfileInterface $user
		 */
		$user = $parameters['user'];
		/**
		 * @var ProfileGetInterface $profile
		 */
		$profile = $parameters['profile'];

		$database_profile = $this->socialProfileRepository->findByUserAndProvider($user, 'UserProfile');
		if($database_profile === null) {
			$this->copyProfileToDatabase($profile);
		}
	}

	/**
	 * Make a new DatabaseProfile as copy of $profile
	 * 
	 * @param ProfileGetInterface $profile
	 * @return bool
	 */
	protected function copyProfileToDatabase(ProfileGetInterface $profile) {
		$databaseProfile = $this->socialProfileRepository->create();
		$databaseProfile->copy($profile);
		$databaseProfile->setProvider("UserProfile");
		return $this->socialProfileRepository->saveProfile($databaseProfile);
	}
} 