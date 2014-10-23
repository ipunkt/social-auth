<?php


namespace Ipunkt\SocialAuth\Profile;


/**
 * Class ProfileCopyTrait
 * @package Ipunkt\SocialAuth\Profile
 * 
 * Provides the copy function for a ProfileSetInterface implementation. Uses the corresponding set function to each get
 * function.
 */
trait ProfileCopyTrait {
	public function copy(ProfileGetInterface $profile) {
		$this->setAddress($profile->getAddress());
		$this->setProfileUrl($profile->getProfileUrl());
		$this->setWebsiteUrl($profile->getWebsiteUrl());
		$this->setPhotoUrl($profile->getPhotoUrl());
		$this->setDisplayName($profile->getDisplayName());
		$this->setDescription($profile->getDescription());
		$this->setFirstName($profile->getFirstName());
		$this->setLastName($profile->getLastName());
		$this->setGender($profile->getGender());
		$this->setLanguage($profile->getLanguage());
		$this->setAge($profile->getAge());
		$this->setBirthDay($profile->getBirthDay());
		$this->setBirthMonth($profile->getBirthMonth());
		$this->setBirthYear($profile->getBirthYear());
		$this->setEmail($profile->getEmail());
		$this->setVerifiedEmail($profile->getVerifiedEmail());
		$this->setPhone($profile->getPhone());
		$this->setAddress($profile->getAddress());
		$this->setCountry($profile->getCountry());
		$this->setRegion($profile->getRegion());
		$this->setCity($profile->getCity());
		$this->setZip($profile->getZip());
	}
} 