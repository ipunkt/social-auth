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
		return $this->getValue('Provider');
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
		return $this->getValue('WebsiteUrl');
	}

	/**
	 * @return string
	 */
	function getPhotoUrl() {
		return $this->getValue('PhotoUrl');
	}

	/**
	 * @return string
	 */
	function getDisplayName() {
		return $this->getValue('DisplayName');
	}

	/**
	 * @return string
	 */
	function getDescription() {
		return $this->getValue('Description');
	}

	/**
	 * @return string
	 */
	function getFirstName() {
		return $this->getValue('FirstName');
	}

	/**
	 * @return string
	 */
	function getLastName() {
		return $this->getValue('LastName');
	}

	/**
	 * @return string
	 */
	function getGender() {
		return $this->getValue('Gender');
	}

	/**
	 * @return string
	 */
	function getLanguage() {
		return $this->getValue('Language');
	}

	/**
	 * @return string
	 */
	function getAge() {
		return $this->getValue('Age');
	}

	/**
	 * @return string
	 */
	function getBirthDay() {
		return $this->getValue('BirthDay');
	}

	/**
	 * @return string
	 */
	function getBirthMonth() {
		return $this->getValue('BirthMonth');
	}

	/**
	 * @return string
	 */
	function getBirthYear() {
		return $this->getValue('BirthYear');
	}

	/**
	 * @return string
	 */
	function getEmail() {
		return $this->getValue('Email');
	}

	/**
	 * @return string
	 */
	function getVerifiedEmail() {
		return $this->getValue('VerifiedEmail');
	}

	/**
	 * @return string
	 */
	function getPhone() {
		return $this->getValue('Phone');
	}

	/**
	 * @return string
	 */
	function getAddress() {
		return $this->getValue('Address');
	}

	/**
	 * @return string
	 */
	function getCountry() {
		return $this->getValue('Country');
	}

	/**
	 * @return string
	 */
	function getRegion() {
		return $this->getValue('Region');
	}

	/**
	 * @return string
	 */
	function getCity() {
		return $this->getValue('City');
	}

	/**
	 * @return string
	 */
	function getZip() {
		return $this->getValue('Zip');
	}


} 