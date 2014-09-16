<?php namespace Ipunkt\SocialAuth\Composers;

class SocialLink implements SocialLinkInterface {
    public $url;
    public $image;
    public $name;

    function getUrl() {
        return $this->url;
    }

    function getName() {
        return $this->name;
    }

    function getButton() {
        return "<img src=\"{$this->image}\">";
    }

    function getLink($inner) {
        return "<a href=\"{$this->url}\">$inner</a>";
    }

} 