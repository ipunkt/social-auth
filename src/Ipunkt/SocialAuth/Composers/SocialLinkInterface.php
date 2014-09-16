<?php


namespace Ipunkt\SocialAuth\Composers;


interface SocialLinkInterface {
    function getUrl();

    function getName();

    function getButton();

    function getLink($inner);
}