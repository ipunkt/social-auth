<?php namespace Ipunkt\SocialAuth\Profile;
use Ipunkt\SocialAuth\Provider\ProviderInterface;

/**
 * Class CompositeProfile
 * @package Ipunkt\SocialAuth\Profile
 * 
 * Dieses Klasse
 */
class CompositeProfile implements ProfileGetInterface {
	/**
	 * @var ProfileGetInterface[]
	 */
	protected $readProfiles;

	/**
	 * @var ProfileSetInterface|null
	 */
	protected $writeProfile;
	/**
	 * @var ProviderInterface
	 */
	private $provider;

	/**
	 * @param $readProfiles
	 * @param null $writeProfiles
	 */
	public function __construct(ProviderInterface $provider, $readProfiles, $writeProfiles = null) {

		$this->readProfiles = $readProfiles;
		$this->writeProfile = $writeProfiles;
		$this->provider = $provider;
	}

	/**
	 * Searches all profiles for the given value
	 * 
	 * @param $field
	 * @return mixed
	 */
	protected function getValue($field) {
		$value = null;
		$readField = 'get'.$field;

		foreach($this->readProfiles as $profile) {
			
			$value = $profile->$readField();
			if($value !== null) {
				$this->setValue($field, $value);
				break;
			}
		}
		

		return $value;
	}
	
	protected function setValue($field, $value) {
		$writeField = 'set'.$field;
		
		foreach($this->writeProfile as $profile) {
			$profile->$writeField($value);
		}
	}

	/**
	 * @return ProviderInterface
	 */
	function getProvider() {
		$this->getValue('getProvider');
	}


	/**
	 * @return string
	 */
	function getIdentifier() {
		return $this->getValue('getIdentifier');
	}

	/**
	 * @return string
	 */
	function getProfileUrl() {
		return $this->getValue('getProfileUrl');
	}

	/**
	 * @return string
	 */
	function getWebsiteUrl() {
		$this->getValue('getWebsiteUrl');
	}

	/**
	 * @return string
	 */
	function getPhotoUrl() {
		$this->getValue('getPhotoUrl');
	}

	/**
	 * @return string
	 */
	function getDisplayName() {
		$this->getValue('getDisplayName');
	}

	/**
	 * @return string
	 */
	function getDescription() {
		$this->getValue('getDescription');
	}

	/**
	 * @return string
	 */
	function getFirstName() {
		$this->getValue('getFirstName');
	}

	/**
	 * @return string
	 */
	function getLastName() {
		$this->getValue('getLastName');
	}

	/**
	 * @return string
	 */
	function getGender() {
		$this->getValue('getGender');
	}

	/**
	 * @return string
	 */
	function getLanguage() {
		$this->getValue('getLanguage');
	}

	/**
	 * @return string
	 */
	function getAge() {
		$this->getValue('getAge');
	}

	/**
	 * @return string
	 */
	function getBirthDay() {
		$this->getValue('getBirthDay');
	}

	/**
	 * @return string
	 */
	function getBirthMonth() {
		$this->getValue('getBirthMonth');
	}

	/**
	 * @return string
	 */
	function getBirthYear() {
		$this->getValue('getBirthYear');
	}

	/**
	 * @return string
	 */
	function getEmail() {
		$this->getValue('getEmail');
	}

	/**
	 * @return string
	 */
	function getVerifiedEmail() {
		$this->getValue('getVerifiedEmail');
	}

	/**
	 * @return string
	 */
	function getPhone() {
		$this->getValue('getPhone');
	}

	/**
	 * @return string
	 */
	function getAddress() {
		$this->getValue('getAddress');
	}

	/**
	 * @return string
	 */
	function getCountry() {
		$this->getValue('getCountry');
	}

	/**
	 * @return string
	 */
	function getRegion() {
		$this->getValue('getRegion');
	}

	/**
	 * @return string
	 */
	function getCity() {
		$this->getValue('getCity');
	}

	/**
	 * @return string
	 */
	function getZip() {
		$this->getValue('getZip');
	}


} 