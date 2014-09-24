<?php namespace Ipunkt\SocialAuth\Profile;

use Hybrid_User_Profile;

/**
 * Class HybridAuthProfile
 * @package Ipunkt\SocialAuth\Profile
 * 
 * Wrapper around Hybrid_User_Profile
 */
class HybridAuthProfile implements ProfileInterface {
	/**
	 * @var Hybrid_User_Profile
	 */
	protected $profile;

	public function setProfile(Hybrid_User_Profile $profile) {
		$this->profile = $profile;
	}
	
	/**
	 * @return string
	 */
	function getIdentifier() {
		return $this->profile->identifier;
	}

	/**
	 * @return string
	 */
	function getProfileUrl() {
		return $this->profile->profileURL;
	}

	/**
	 * @return string
	 */
	function getWebsiteUrl() {
		return $this->profile->webSiteURL;
	}

	/**
	 * @return string
	 */
	function getPhotoUrl() {
		return $this->profile->photoURL;
	}

	/**
	 * @return string
	 */
	function getDisplayName() {
		return $this->profile->displayName;
	}

	/**
	 * @return string
	 */
	function getDescription() {
		return $this->profile->description;
	}

	/**
	 * @return string
	 */
	function getFirstName() {
		return $this->profile->firstName;
	}

	/**
	 * @return string
	 */
	function getLastName() {
		return $this->profile->lastName;
	}

	/**
	 * @return string
	 */
	function getGender() {
		return $this->profile->gender;
	}

	/**
	 * @return string
	 */
	function getLanguage() {
		return $this->profile->language;
	}

	/**
	 * @return string
	 */
	function getAge() {
		return $this->profile->age;
	}

	/**
	 * @return string
	 */
	function getBirthDay() {
		return $this->profile->birthDay;
	}

	/**
	 * @return string
	 */
	function getBirthMonth() {
		return $this->profile->birthMonth;
	}

	/**
	 * @return string
	 */
	function getBirthYear() {
		return $this->profile->birthYear;
	}

	/**
	 * @return string
	 */
	function getEmail() {
		return $this->profile->email;
	}

	/**
	 * @return string
	 */
	function getVerifiedEmail() {
		return $this->profile->emailVerified;
	}

	/**
	 * @return string
	 */
	function getPhone() {
		return $this->profile->phone;
	}

	/**
	 * @return string
	 */
	function getAddress() {
		return $this->profile->address;
	}

	/**
	 * @return string
	 */
	function getCountry() {
		return $this->profile->country;
	}

	/**
	 * @return string
	 */
	function getRegion() {
		return $this->profile->region;
	}

	/**
	 * @return string
	 */
	function getCity() {
		return $this->profile->city;
	}

	/**
	 * @return string
	 */
	function getZip() {
		return $this->profile->zip;
	}

} 