<?php namespace Ipunkt\SocialAuth;


use Config;
use \Eloquent;
use Illuminate\Auth\UserInterface;
use Ipunkt\SocialAuth\Profile\ProfileGetInterface;
use Ipunkt\SocialAuth\Profile\ProfileSetInterface;

/**
 * Class SocialProfile
 * @property string provider
 * @property string identifier
 * @property UserInterface user
 * 
 * @property string $profile_url
 * @property string $website_url
 * @property string $photo_url
 * @property string $display_name
 * @property string $description
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $language
 * @property string $age
 * @property int $birth_day
 * @property int $birth_month
 * @property int $birth_year
 * @property string $email
 * @property string $verified_email
 * @property string $phone
 * @property string $address
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $zip
 * 
 * @package Ipunkt\SocialAuth
 *
 */
class SocialProfile extends Eloquent implements SocialLoginInterface, ProfileGetInterface, ProfileSetInterface {
    /**
     * @var string
     */
    protected $table = "social_profiles";

    /**
     * @var array
     */
    protected $fillable = [];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        $model = Config::get('auth.model');
        return $this->belongsTo($model, 'user_id');
    }

    /**
     * get the name of the provider this social login connects with
     *
     * return string
     */
    public function getProvider() {
        return $this->provider;
    }

    /**
     * Get the Identifier this user has on the provider
     *
     * @return string
     */
    public function getIdentifier() {
        return $this->identifier;
    }

    /**
     * Get the user which is identified by this identifier on this provider
     *
     * @return UserInterface|null
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set the given
     *
     * @param string $provider_name
     */
    public function setProvider($provider_name) {
        $this->provider = $provider_name;
    }

    /**
     * Set identifier to the given string
     *
     * @param string $identifier
     */
    public function setIdentifier($identifier) {
        $this->identifier = $identifier;
    }

    /**
     * Set user by id
     *
     * @param int $id
     */
    public function setUser($id) {
        $this->user_id = $id;
    }

	/**
	 * @return string
	 */
	public function getProfileUrl() {
		return $this->profile_url;
	}

	/**
	 * @return string
	 */
	public function getWebsiteUrl() {
		return $this->website_url;
	}

	/**
	 * @return string
	 */
	public function getPhotoUrl() {
		return $this->photo_url;
	}

	/**
	 * @return string
	 */
	public function getDisplayName() {
		return $this->display_name;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->first_name;
	}

	/**
	 * @return string
	 */
	public function getLastName() {
		return $this->last_name;
	}

	/**
	 * @return string
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @return string
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @return string
	 */
	public function getAge() {
		return $this->age;
	}

	/**
	 * @return string
	 */
	public function getBirthDay() {
		return $this->birth_day;
	}

	/**
	 * @return string
	 */
	public function getBirthMonth() {
		return $this->birth_month;
	}

	/**
	 * @return string
	 */
	public function getBirthYear() {
		return $this->birth_year;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getVerifiedEmail() {
		return $this->verified_email;
	}

	/**
	 * @return string
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @return string
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function getZip() {
		return $this->zip;
	}

	/*
	 * ProfileSetInterface
	 */
	/**
	 * @param $value
	 * @return null
	 */
	public function setProfileUrl($value) {
		$this->profile_url = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setWebsiteUrl($value) {
		$this->website_url = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setPhotoUrl($value) {
		$this->photo_url = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setDisplayName($value) {
		$this->display_name = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setDescription($value) {
		$this->description = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setFirstName($value) {
		$this->first_name = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setLastName($value) {
		$this->last_name = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setGender($value) {
		$this->gender = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setLanguage($value) {
		$this->language = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setAge($value) {
		$this->age = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setBirthDay($value) {
		$this->birth_day = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setBirthMonth($value) {
		$this->birth_month = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setBirthYear($value) {
		$this->birth_year = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setEmail($value) {
		$this->email = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setVerifiedEmail($value) {
		$this->verified_email = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setPhone($value) {
		$this->phone = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setAddress($value) {
		$this->address = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setCountry($value) {
		$this->country = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setRegion($value) {
		$this->region = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setCity($value) {
		$this->city = $value;
	}

	/**
	 * @param $value
	 * @return null
	 */
	public function setZip($value) {
		$this->zip = $value;
	}

	public function __destruct() {
		$this->save();
	}
	
}
