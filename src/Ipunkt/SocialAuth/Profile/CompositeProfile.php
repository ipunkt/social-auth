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
		$this->getValue('Provider');
	}


	/**
	 * @return string
	 */
	function getIdentifier() {
		return $this->getValue('Identifier');
	}

	/**
	 * @return string
	 */
	function getProfileUrl() {
		return $this->getValue('ProfileUrl');
	}

	/**
	 * @return string
	 */
	function getWebsiteUrl() {
		$this->getValue('WebsiteUrl');
	}

	/**
	 * @return string
	 */
	function getPhotoUrl() {
		$this->getValue('PhotoUrl');
	}

	/**
	 * @return string
	 */
	function getDisplayName() {
		$this->getValue('DisplayName');
	}

	/**
	 * @return string
	 */
	function getDescription() {
		$this->getValue('Description');
	}

	/**
	 * @return string
	 */
	function getFirstName() {
		$this->getValue('FirstName');
	}

	/**
	 * @return string
	 */
	function getLastName() {
		$this->getValue('LastName');
	}

	/**
	 * @return string
	 */
	function getGender() {
		$this->getValue('Gender');
	}

	/**
	 * @return string
	 */
	function getLanguage() {
		$this->getValue('Language');
	}

	/**
	 * @return string
	 */
	function getAge() {
		$this->getValue('Age');
	}

	/**
	 * @return string
	 */
	function getBirthDay() {
		$this->getValue('BirthDay');
	}

	/**
	 * @return string
	 */
	function getBirthMonth() {
		$this->getValue('BirthMonth');
	}

	/**
	 * @return string
	 */
	function getBirthYear() {
		$this->getValue('BirthYear');
	}

	/**
	 * @return string
	 */
	function getEmail() {
		$this->getValue('Email');
	}

	/**
	 * @return string
	 */
	function getVerifiedEmail() {
		$this->getValue('VerifiedEmail');
	}

	/**
	 * @return string
	 */
	function getPhone() {
		$this->getValue('Phone');
	}

	/**
	 * @return string
	 */
	function getAddress() {
		$this->getValue('Address');
	}

	/**
	 * @return string
	 */
	function getCountry() {
		$this->getValue('Country');
	}

	/**
	 * @return string
	 */
	function getRegion() {
		$this->getValue('Region');
	}

	/**
	 * @return string
	 */
	function getCity() {
		$this->getValue('City');
	}

	/**
	 * @return string
	 */
	function getZip() {
		$this->getValue('Zip');
	}


} 