<?php namespace Ipunkt\SocialAuth\SocialLink;

/**
 * Class SocialLink
 * @package Ipunkt\SocialAuth\Composers
 */
/**
 * Class SocialLink
 * @package Ipunkt\SocialAuth\SocialLink
 */
class SocialLink implements SocialLinkInterface {
	/**
	 * @var string
	 */
	public $url;
	/**
	 * @var string
	 */
	public $image;
	/**
	 * @var string
	 */
	public $name;

	/**
	 * @return mixed
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getButton() {
		return "<img src=\"{$this->image}\">";
	}

	/**
	 * @param null $inner
	 * @return string
	 */
	public function getLink($inner = null) {
		return "<a href=\"{$this->url}\">$inner</a>";
	}

} 